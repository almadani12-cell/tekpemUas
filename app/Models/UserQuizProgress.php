<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserQuizProgress extends Model
{
    use HasFactory;

    protected $table = 'user_quiz_progress';

    protected $fillable = [
        'user_id',
        'pillar_id',
        'unlocked_level',
        'best_score_level_1',
        'best_score_level_2',
        'best_score_level_3',
    ];

    protected $casts = [
        'best_score_level_1' => 'decimal:2',
        'best_score_level_2' => 'decimal:2',
        'best_score_level_3' => 'decimal:2',
    ];

    /**
     * Get the user that owns the progress.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the pillar that this progress belongs to.
     */
    public function pillar(): BelongsTo
    {
        return $this->belongsTo(Pillar::class);
    }

    /**
     * Check if a level is unlocked.
     */
    public function isLevelUnlocked(int $level): bool
    {
        return $level <= $this->unlocked_level;
    }

    /**
     * Get best score for a specific level.
     */
    public function getBestScore(int $level): ?float
    {
        return $this->{"best_score_level_{$level}"};
    }

    /**
     * Update best score for a specific level.
     */
    public function updateBestScore(int $level, float $score): void
    {
        $currentBest = $this->getBestScore($level);
        
        if ($currentBest === null || $score > $currentBest) {
            $this->{"best_score_level_{$level}"} = $score;
            $this->save();
        }
    }

    /**
     * Unlock next level if score meets threshold.
     */
    public function checkAndUnlockNextLevel(int $currentLevel, float $score, float $threshold = 80.0): bool
    {
        if ($score >= $threshold && $currentLevel < 3 && $this->unlocked_level < $currentLevel + 1) {
            $this->unlocked_level = $currentLevel + 1;
            $this->save();
            return true;
        }
        
        return false;
    }
}
