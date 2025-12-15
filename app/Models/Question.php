<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'type',
        'content',
        'explanation',
        'order',
    ];

    /**
     * Get the quiz that owns the question.
     */
    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }

    /**
     * Get all options for this question.
     */
    public function options(): HasMany
    {
        return $this->hasMany(QuestionOption::class)->orderBy('order');
    }

    /**
     * Get the correct option for multiple choice questions.
     */
    public function correctOption()
    {
        return $this->options()->where('is_correct', true)->first();
    }

    /**
     * Get options in correct order for drag-drop questions.
     */
    public function getCorrectOrderAttribute(): array
    {
        return $this->options()->orderBy('order')->pluck('id')->toArray();
    }

    /**
     * Check if this is a multiple choice question.
     */
    public function isMultipleChoice(): bool
    {
        return $this->type === 'multiple_choice';
    }

    /**
     * Check if this is a drag-drop question.
     */
    public function isDragDrop(): bool
    {
        return $this->type === 'drag_drop';
    }
}
