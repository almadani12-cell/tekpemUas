<?php

namespace App\Http\Controllers;

use App\Models\Pillar;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\QuizAnswer;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluasiController extends Controller
{
    /**
     * Display the evaluasi index page with quiz selection.
     */
    public function index()
    {
        $pillars = Pillar::with('quiz')->orderBy('order')->get();
        $user = Auth::user();

        // Get best scores for each pillar
        $bestScores = [];
        foreach ($pillars as $pillar) {
            if ($pillar->quiz) {
                $bestAttempt = QuizAttempt::where('user_id', $user->id)
                    ->where('quiz_id', $pillar->quiz->id)
                    ->whereNotNull('completed_at')
                    ->orderBy('score', 'desc')
                    ->first();
                $bestScores[$pillar->id] = $bestAttempt ? $bestAttempt->score : null;
            }
        }

        return view('evaluasi.index', compact('pillars', 'bestScores'));
    }

    /**
     * Start a new quiz attempt.
     */
    public function startQuiz(Pillar $pillar)
    {
        $quiz = $pillar->quiz;
        
        if (!$quiz) {
            return redirect()->route('evaluasi.index')
                ->with('error', 'Quiz untuk pilar ini belum tersedia.');
        }

        $user = Auth::user();

        // Check for existing incomplete attempt
        $existingAttempt = QuizAttempt::where('user_id', $user->id)
            ->where('quiz_id', $quiz->id)
            ->whereNull('completed_at')
            ->first();

        if ($existingAttempt) {
            // Resume existing attempt
            $attempt = $existingAttempt;
        } else {
            // Create new attempt
            $attempt = QuizAttempt::create([
                'user_id' => $user->id,
                'quiz_id' => $quiz->id,
                'total_questions' => $quiz->questions()->count(),
                'started_at' => now(),
            ]);
        }

        return redirect()->route('evaluasi.quiz', ['pillar' => $pillar, 'attempt' => $attempt]);
    }

    /**
     * Display the quiz interface.
     */
    public function quiz(Pillar $pillar, QuizAttempt $attempt)
    {
        // Verify ownership
        if ($attempt->user_id !== Auth::id()) {
            abort(403);
        }

        // Check if already completed
        if ($attempt->isCompleted()) {
            return redirect()->route('evaluasi.review', ['pillar' => $pillar, 'attempt' => $attempt]);
        }

        $quiz = $attempt->quiz;
        $questions = $quiz->questions()->with('options')->get();
        
        // Get answered question IDs
        $answeredQuestionIds = $attempt->answers()->pluck('question_id')->toArray();

        // Find current question (first unanswered)
        $currentQuestion = $questions->first(function ($question) use ($answeredQuestionIds) {
            return !in_array($question->id, $answeredQuestionIds);
        });

        // If all answered, redirect to review
        if (!$currentQuestion) {
            $attempt->update(['completed_at' => now()]);
            $attempt->calculateScore();
            return redirect()->route('evaluasi.review', ['pillar' => $pillar, 'attempt' => $attempt]);
        }

        $currentIndex = $questions->search(fn($q) => $q->id === $currentQuestion->id);
        $totalQuestions = $questions->count();
        $progress = count($answeredQuestionIds);

        return view('evaluasi.quiz', compact(
            'pillar', 
            'attempt', 
            'quiz', 
            'currentQuestion', 
            'currentIndex',
            'totalQuestions',
            'progress',
            'answeredQuestionIds'
        ));
    }

    /**
     * Submit an answer for a question.
     */
    public function submitAnswer(Request $request, Pillar $pillar, QuizAttempt $attempt)
    {
        // Verify ownership
        if ($attempt->user_id !== Auth::id()) {
            abort(403);
        }

        // Check if already completed
        if ($attempt->isCompleted()) {
            return redirect()->route('evaluasi.review', ['pillar' => $pillar, 'attempt' => $attempt]);
        }

        $request->validate([
            'question_id' => 'required|exists:questions,id',
            'selected_option_id' => 'nullable|exists:question_options,id',
            'drag_drop_order' => 'nullable|array',
        ]);

        $question = Question::findOrFail($request->question_id);

        // Check if already answered
        $existingAnswer = $attempt->answers()->where('question_id', $question->id)->first();
        if ($existingAnswer) {
            return redirect()->route('evaluasi.quiz', ['pillar' => $pillar, 'attempt' => $attempt])
                ->with('error', 'Pertanyaan ini sudah dijawab.');
        }

        // Create answer
        $answer = QuizAnswer::create([
            'quiz_attempt_id' => $attempt->id,
            'question_id' => $question->id,
            'selected_option_id' => $request->selected_option_id,
            'drag_drop_order' => $request->drag_drop_order,
            'is_correct' => false, // Will be updated below
        ]);

        // Check correctness
        $isCorrect = $answer->checkCorrectness();
        $answer->update(['is_correct' => $isCorrect]);

        // Get feedback data
        $feedback = [
            'is_correct' => $isCorrect,
            'explanation' => $question->explanation,
            'question_id' => $question->id,
        ];

        if ($question->isMultipleChoice()) {
            $correctOption = $question->correctOption();
            $feedback['correct_answer'] = $correctOption ? $correctOption->content : null;
        } else {
            $feedback['correct_order'] = $question->options()->orderBy('order')->pluck('content')->toArray();
        }

        // Check if this was the last question
        $quiz = $attempt->quiz;
        $totalQuestions = $quiz->questions()->count();
        $answeredCount = $attempt->answers()->count();

        if ($answeredCount >= $totalQuestions) {
            $attempt->update(['completed_at' => now()]);
            $attempt->calculateScore();
            
            return redirect()->route('evaluasi.review', ['pillar' => $pillar, 'attempt' => $attempt])
                ->with('last_feedback', $feedback);
        }

        // Continue to next question with feedback
        return redirect()->route('evaluasi.quiz', ['pillar' => $pillar, 'attempt' => $attempt])
            ->with('feedback', $feedback);
    }

    /**
     * Display quiz review/results.
     */
    public function review(Pillar $pillar, QuizAttempt $attempt)
    {
        // Verify ownership
        if ($attempt->user_id !== Auth::id()) {
            abort(403);
        }

        // Ensure attempt is completed
        if (!$attempt->isCompleted()) {
            return redirect()->route('evaluasi.quiz', ['pillar' => $pillar, 'attempt' => $attempt]);
        }

        $quiz = $attempt->quiz;
        $answers = $attempt->answers()->with(['question.options', 'selectedOption'])->get();

        return view('evaluasi.review', compact('pillar', 'attempt', 'quiz', 'answers'));
    }
}
