<?php

namespace App\Http\Controllers;

use App\Models\Pillar;
use App\Models\QuizAnswer;
use App\Models\QuizAttempt;
use App\Models\UserQuizProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class QuizLevelController extends Controller
{
    /**
     * Display level selection page for a pillar.
     */
    public function selectLevel(Pillar $pillar)
    {
        $user = Auth::user();
        
        // Get or create user progress for this pillar
        $progress = UserQuizProgress::firstOrCreate(
            [
                'user_id' => $user->id,
                'pillar_id' => $pillar->id,
            ],
            [
                'unlocked_level' => 1,
            ]
        );

        // Check which level files exist
        $availableLevels = [];
        for ($level = 1; $level <= 3; $level++) {
            $filePath = resource_path("content/quiz/{$pillar->slug}/level-{$level}.json");
            if (File::exists($filePath)) {
                $availableLevels[] = $level;
            }
        }

        return view('evaluasi.levels', compact('pillar', 'progress', 'availableLevels'));
    }

    /**
     * Start a quiz for a specific level.
     */
    public function startLevel(Pillar $pillar, int $level)
    {
        $user = Auth::user();
        
        // Get user progress
        $progress = UserQuizProgress::where('user_id', $user->id)
            ->where('pillar_id', $pillar->id)
            ->first();

        // Check if level is unlocked
        if (!$progress || !$progress->isLevelUnlocked($level)) {
            return redirect()->route('evaluasi.levels', $pillar)
                ->with('error', 'Level ini belum terbuka. Selesaikan level sebelumnya dengan minimal 80%.');
        }

        // Load quiz data from JSON
        $quizData = $this->loadQuizData($pillar->slug, $level);
        
        if (!$quizData) {
            return redirect()->route('evaluasi.levels', $pillar)
                ->with('error', 'Quiz untuk level ini belum tersedia.');
        }

        // Create new attempt
        $attempt = QuizAttempt::create([
            'user_id' => $user->id,
            'quiz_id' => $pillar->quiz->id ?? null,
            'level' => $level,
            'total_questions' => $quizData['total_questions'],
            'max_points' => $quizData['total_questions'] * $quizData['points_per_question'],
            'started_at' => now(),
        ]);

        // Store quiz data in session for this attempt
        session()->put("quiz_data_{$attempt->id}", $quizData);

        return redirect()->route('evaluasi.quiz-level', [
            'pillar' => $pillar,
            'level' => $level,
            'attempt' => $attempt
        ]);
    }

    /**
     * Display quiz interface for level-based quiz.
     */
    public function showQuiz(Pillar $pillar, int $level, QuizAttempt $attempt)
    {
        // Verify ownership
        if ($attempt->user_id !== Auth::id()) {
            abort(403);
        }

        // Check if already completed
        if ($attempt->completed_at) {
            return redirect()->route('evaluasi.results', [
                'pillar' => $pillar,
                'level' => $level,
                'attempt' => $attempt
            ]);
        }

        // Get quiz data from session
        $quizData = session()->get("quiz_data_{$attempt->id}");
        
        if (!$quizData) {
            // Reload from file if session expired
            $quizData = $this->loadQuizData($pillar->slug, $level);
            session()->put("quiz_data_{$attempt->id}", $quizData);
        }

        // Fix for old attempts with max_points = 0
        if ($attempt->max_points == 0) {
            $attempt->max_points = $quizData['total_questions'] * $quizData['points_per_question'];
            $attempt->save();
        }

        // Get answered questions
        $answeredQuestions = $attempt->answers()
            ->pluck('question_identifier')
            ->toArray();

        // Find current question (first unanswered)
        $currentQuestion = null;
        $currentIndex = 0;
        
        foreach ($quizData['questions'] as $index => $question) {
            if (!in_array($question['id'], $answeredQuestions)) {
                $currentQuestion = $question;
                $currentIndex = $index;
                break;
            }
        }

        // If all answered, redirect to results
        if (!$currentQuestion) {
            $this->completeAttempt($attempt, $quizData, $pillar->id);
            return redirect()->route('evaluasi.results', [
                'pillar' => $pillar,
                'level' => $level,
                'attempt' => $attempt
            ]);
        }

        $totalQuestions = $quizData['total_questions'];
        $progress = count($answeredQuestions);

        return view('evaluasi.quiz-level', compact(
            'pillar',
            'level',
            'attempt',
            'quizData',
            'currentQuestion',
            'currentIndex',
            'totalQuestions',
            'progress',
            'answeredQuestions'
        ));
    }

    /**
     * Submit answer for a question.
     */
    public function submitAnswer(Request $request, Pillar $pillar, int $level, QuizAttempt $attempt)
    {
        // Verify ownership
        if ($attempt->user_id !== Auth::id()) {
            abort(403);
        }

        // Check if already completed
        if ($attempt->completed_at) {
            return redirect()->route('evaluasi.results', [
                'pillar' => $pillar,
                'level' => $level,
                'attempt' => $attempt
            ]);
        }

        $request->validate([
            'question_id' => 'required|string',
            'selected_option' => 'nullable|string', // for one_choice
            'selected_options' => 'nullable|array', // for multiple_choices
            'sequence' => 'nullable|array', // for drag_drop sequence
            'matches' => 'nullable|array', // for drag_drop matching
        ]);

        // Get quiz data
        $quizData = session()->get("quiz_data_{$attempt->id}");
        
        if (!$quizData) {
            $quizData = $this->loadQuizData($pillar->slug, $level);
        }

        // Find the question
        $question = collect($quizData['questions'])->firstWhere('id', $request->question_id);
        
        if (!$question) {
            return back()->with('error', 'Soal tidak ditemukan.');
        }

        // Check if already answered
        $existingAnswer = $attempt->answers()
            ->where('question_identifier', $request->question_id)
            ->first();

        if ($existingAnswer) {
            return redirect()->route('evaluasi.quiz-level', [
                'pillar' => $pillar,
                'level' => $level,
                'attempt' => $attempt
            ])->with('error', 'Soal ini sudah dijawab.');
        }

        // Validate answer based on question type
        $isCorrect = $this->validateAnswer($question, $request);

        // Calculate points earned
        $pointsEarned = $isCorrect ? $quizData['points_per_question'] : 0;

        // Prepare answer data based on question type
        $answerData = [
            'quiz_attempt_id' => $attempt->id,
            'question_id' => null, // Not using old system
            'question_identifier' => $request->question_id,
            'is_correct' => $isCorrect,
            'points_earned' => $pointsEarned,
        ];

        // Set answer data based on question type
        // For JSON-based questions, store all answers in JSON fields
        // Note: selected_options and drag_drop_order are cast as arrays in the model
        if ($question['type'] === 'one_choice') {
            // Store as array for consistency (even single values)
            $answerData['selected_options'] = [$request->input('selected_option')];
        } elseif ($question['type'] === 'multiple_choices') {
            $answerData['selected_options'] = $request->input('selected_options', []);
        } elseif ($question['type'] === 'drag_drop') {
            if ($question['drag_drop_type'] === 'sequence') {
                $answerData['drag_drop_order'] = $request->input('sequence', []);
            } elseif ($question['drag_drop_type'] === 'matching') {
                $answerData['selected_options'] = $request->input('matches', []);
            }
        }

        // Save answer
        $answer = QuizAnswer::create($answerData);

        // Update attempt points
        $attempt->increment('points_earned', $pointsEarned);
        
        // Refresh attempt to get latest data
        $attempt->refresh();

        // Check if this was the last question
        $answeredCount = $attempt->answers()->count();

        if ($answeredCount >= $quizData['total_questions']) {
            $this->completeAttempt($attempt, $quizData, $pillar->id);
            
            return redirect()->route('evaluasi.results', [
                'pillar' => $pillar,
                'level' => $level,
                'attempt' => $attempt
            ]);
        }

        // Continue to next question
        return redirect()->route('evaluasi.quiz-level', [
            'pillar' => $pillar,
            'level' => $level,
            'attempt' => $attempt
        ]);
    }

    /**
     * Display results page with detailed feedback.
     */
    public function results(Pillar $pillar, int $level, QuizAttempt $attempt)
    {
        // Verify ownership
        if ($attempt->user_id !== Auth::id()) {
            abort(403);
        }

        // Ensure completed
        if (!$attempt->completed_at) {
            return redirect()->route('evaluasi.quiz-level', [
                'pillar' => $pillar,
                'level' => $level,
                'attempt' => $attempt
            ]);
        }

        // Get quiz data
        $quizData = session()->get("quiz_data_{$attempt->id}");
        
        if (!$quizData) {
            $quizData = $this->loadQuizData($pillar->slug, $level);
        }

        // Get all answers with details
        $answers = $attempt->answers()->get();

        // Map answers to questions
        $results = [];
        foreach ($quizData['questions'] as $question) {
            $answer = $answers->firstWhere('question_identifier', $question['id']);
            $results[] = [
                'question' => $question,
                'answer' => $answer,
            ];
        }

        // Get user progress
        $progress = UserQuizProgress::where('user_id', Auth::id())
            ->where('pillar_id', $pillar->id)
            ->first();

        $unlocked = false;
        if ($attempt->percentage >= $quizData['pass_threshold'] && $level < 3) {
            $unlocked = $progress && $progress->unlocked_level > $level;
        }

        return view('evaluasi.results', compact(
            'pillar',
            'level',
            'attempt',
            'quizData',
            'results',
            'progress',
            'unlocked'
        ));
    }

    /**
     * Load quiz data from JSON file.
     */
    private function loadQuizData(string $pillarSlug, int $level): ?array
    {
        $filePath = resource_path("content/quiz/{$pillarSlug}/level-{$level}.json");
        
        if (!File::exists($filePath)) {
            return null;
        }

        $json = File::get($filePath);
        return json_decode($json, true);
    }

    /**
     * Validate answer based on question type.
     */
    private function validateAnswer(array $question, Request $request): bool
    {
        switch ($question['type']) {
            case 'one_choice':
                return $request->input('selected_option') === $question['correct_answer'];
                
            case 'multiple_choices':
                $userAnswers = $request->input('selected_options', []);
                sort($userAnswers);
                $correctAnswers = $question['correct_answers'];
                sort($correctAnswers);
                return $userAnswers === $correctAnswers;
                
            case 'drag_drop':
                if ($question['drag_drop_type'] === 'sequence') {
                    return $request->input('sequence') === $question['correct_order'];
                } elseif ($question['drag_drop_type'] === 'matching') {
                    // Validate matching pairs
                    $userMatches = $request->input('matches', []);
                    $correctMatches = $question['correct_matches'];
                    return $userMatches == $correctMatches;
                }
                return false;
                
            default:
                return false;
        }
    }

    /**
     * Complete attempt and update progress.
     */
    private function completeAttempt(QuizAttempt $attempt, array $quizData, int $pillarId): void
    {
        $attempt->completed_at = now();
        $attempt->correct_answers = $attempt->answers()->where('is_correct', true)->count();
        
        // Calculate percentage with safety check
        if ($attempt->max_points > 0) {
            $attempt->percentage = ($attempt->points_earned / $attempt->max_points) * 100;
        } else {
            // Fallback: calculate from quiz data
            $maxPoints = $quizData['total_questions'] * $quizData['points_per_question'];
            $attempt->max_points = $maxPoints;
            $attempt->percentage = $maxPoints > 0 ? ($attempt->points_earned / $maxPoints) * 100 : 0;
        }
        
        // Set score to pure percentage: (correct_answers / total_questions) × 100
        $attempt->score = $attempt->total_questions > 0 
            ? round(($attempt->correct_answers / $attempt->total_questions) * 100, 2)
            : 0;
        
        $attempt->save();

        // Update user progress
        $progress = UserQuizProgress::where('user_id', $attempt->user_id)
            ->where('pillar_id', $pillarId)
            ->first();

        if ($progress) {
            $progress->updateBestScore($attempt->level, $attempt->percentage);
            $progress->checkAndUnlockNextLevel($attempt->level, $attempt->percentage, $quizData['pass_threshold']);
        }
    }
}
