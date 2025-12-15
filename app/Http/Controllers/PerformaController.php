<?php

namespace App\Http\Controllers;

use App\Models\Pillar;
use App\Models\QuizAttempt;
use App\Models\UserQuizProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerformaController extends Controller
{
    /**
     * Display the performa/performance page.
     */
    public function index()
    {
        $user = Auth::user();
        $pillars = Pillar::with('quiz')->orderBy('order')->get();

        // Get performance data for each pillar
        $performanceData = [];
        $chartLabels = [];
        $chartScores = [];
        $chartColors = [];

        foreach ($pillars as $pillar) {
            $chartLabels[] = $pillar->name;
            
            // Get progress from user_quiz_progress table (cumulative scores)
            $progress = UserQuizProgress::where('user_id', $user->id)->where('pillar_id', $pillar->id)->first();
            
            if ($progress) {
                // Calculate cumulative score: average of all 3 levels
                $level1 = $progress->best_score_level_1 ?? 0;
                $level2 = $progress->best_score_level_2 ?? 0;
                $level3 = $progress->best_score_level_3 ?? 0;
                
                $cumulativeScore = round(($level1 + $level2 + $level3) / 3, 2);
                
                // Count attempts across all levels
                $attemptCount = QuizAttempt::where('user_id', $user->id)
                    ->where('quiz_id', $pillar->quiz->id)
                    ->whereNotNull('completed_at')
                    ->count();

                $performanceData[$pillar->id] = [
                    'pillar' => $pillar,
                    'best_score' => $cumulativeScore,
                    'attempt_count' => $attemptCount,
                    'mastery_level' => $this->getMasteryLevel($cumulativeScore),
                    'suggestion' => $this->getSuggestion($cumulativeScore),
                ];

                $chartScores[] = $cumulativeScore;
            } else {
                $performanceData[$pillar->id] = [
                    'pillar' => $pillar,
                    'best_score' => 0,
                    'attempt_count' => 0,
                    'mastery_level' => 'Belum Dikerjakan',
                    'suggestion' => 'Mulai dengan membaca materi, lalu kerjakan quiz untuk mengukur pemahaman.',
                ];
                $chartScores[] = 0;
            }

            $chartColors[] = $this->getColorHex($pillar->color);
        }

        // Get recent history
        $recentHistory = QuizAttempt::where('user_id', $user->id)
            ->whereNotNull('completed_at')
            ->with('quiz.pillar')
            ->orderBy('completed_at', 'desc')
            ->take(10)
            ->get();

        // Calculate overall stats
        $overallStats = [
            'total_attempts' => QuizAttempt::where('user_id', $user->id)->whereNotNull('completed_at')->count(),
            'average_score' => QuizAttempt::where('user_id', $user->id)->whereNotNull('completed_at')->avg('score') ?? 0,
            'pillars_mastered' => collect($performanceData)->filter(fn($p) => $p['best_score'] > 70)->count(),
            'total_pillars' => $pillars->count(),
        ];

        return view('performa.index', compact(
            'pillars',
            'performanceData',
            'chartLabels',
            'chartScores',
            'chartColors',
            'recentHistory',
            'overallStats'
        ));
    }

    /**
     * Get mastery level based on cumulative score.
     */
    private function getMasteryLevel(float $score): string
    {
        if ($score >= 90) return 'Sangat Baik';
        if ($score > 70) return 'Baik';
        if ($score >= 50) return 'Cukup';
        if ($score > 0) return 'Perlu Belajar Lagi';
        return 'Belum Dikerjakan';
    }

    /**
     * Get suggestion based on cumulative score.
     */
    private function getSuggestion(float $score): string
    {
        if ($score >= 90) return 'Pertahankan! Kamu sudah menguasai materi ini dengan sangat baik.';
        if ($score > 70) return 'Bagus! Sedikit lagi kamu akan menguasai materi ini sepenuhnya.';
        if ($score >= 50) return 'Pelajari kembali materi dan coba quiz lagi untuk meningkatkan pemahaman.';
        if ($score > 0) return 'Baca materi dengan lebih teliti dan pahami konsep dasarnya.';
        return 'Mulai dengan membaca materi, lalu kerjakan quiz untuk mengukur pemahaman.';
    }

    /**
     * Get hex color for chart.
     */
    private function getColorHex(string $color): string
    {
        return match($color) {
            'indigo' => '#6366f1',
            'teal' => '#14b8a6',
            'amber' => '#f59e0b',
            'rose' => '#f43f5e',
            default => '#6366f1',
        };
    }
}
