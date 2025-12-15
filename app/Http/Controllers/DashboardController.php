<?php

namespace App\Http\Controllers;

use App\Models\Pillar;
use App\Models\QuizAttempt;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the user dashboard page.
     */
    public function index()
    {
        $pillars = Pillar::orderBy('order')->get();
        /** @var User $user */
        $user = Auth::user();
        
        // Stats untuk banner
        $totalPillars = $pillars->count(); // 4
        $totalQuizzes = $totalPillars * 3; // 4 pilar × 3 level = 12 quiz
        $totalQuestions = $totalQuizzes * 8; // 12 quiz × 8 soal = 96 soal
        
        // Get user's recent quiz attempts for activity section
        $recentAttempts = QuizAttempt::where('user_id', $user->id)
            ->whereNotNull('completed_at')
            ->with('quiz.pillar')
            ->orderBy('completed_at', 'desc')
            ->take(4)
            ->get();

        // Hitung quiz yang dikuasai (score >= 80%)
        $quizzesMastered = 0;
        foreach ($pillars as $pillar) {
            $progress = $user->quizProgress()->where('pillar_id', $pillar->id)->first();
            if ($progress) {
                if ($progress->best_score_level_1 >= 80) $quizzesMastered++;
                if ($progress->best_score_level_2 >= 80) $quizzesMastered++;
                if ($progress->best_score_level_3 >= 80) $quizzesMastered++;
            }
        }
        
        // Total soal yang sudah diselesaikan (dijawab benar)
        $questionsCompleted = QuizAttempt::where('user_id', $user->id)
            ->whereNotNull('completed_at')
            ->sum('correct_answers');

        return view('dashboard', compact(
            'pillars', 
            'recentAttempts', 
            'totalPillars',
            'totalQuizzes',
            'totalQuestions',
            'quizzesMastered',
            'questionsCompleted'
        ));
    }
}
