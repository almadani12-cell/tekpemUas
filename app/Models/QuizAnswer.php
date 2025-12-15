<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuizAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_attempt_id',
        'question_id',
        'question_identifier', // For JSON-based questions
        'selected_option_id',
        'selected_options', // For multiple choices and JSON-based answers
        'drag_drop_order',
        'is_correct',
        'points_earned',
    ];

    protected $casts = [
        'is_correct' => 'boolean',
        'drag_drop_order' => 'array',
        'selected_options' => 'array',
    ];

    /**
     * Get the attempt that owns the answer.
     */
    public function attempt(): BelongsTo
    {
        return $this->belongsTo(QuizAttempt::class, 'quiz_attempt_id');
    }

    /**
     * Get the question for this answer.
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    /**
     * Get the selected option for this answer.
     */
    public function selectedOption(): BelongsTo
    {
        return $this->belongsTo(QuestionOption::class, 'selected_option_id');
    }

    /**
     * Check if the answer is correct based on question type.
     */
    public function checkCorrectness(): bool
    {
        $question = $this->question;

        if ($question->isMultipleChoice()) {
            $correctOption = $question->correctOption();
            return $correctOption && $this->selected_option_id === $correctOption->id;
        }

        if ($question->isDragDrop()) {
            $correctOrder = $question->correct_order;
            return $this->drag_drop_order === $correctOrder;
        }

        return false;
    }
}
