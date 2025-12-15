<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'pillar_id',
        'title',
        'type',
        'content',
        'video_url',
        'order',
    ];

    /**
     * Get the pillar that owns the material.
     */
    public function pillar(): BelongsTo
    {
        return $this->belongsTo(Pillar::class);
    }

    /**
     * Check if material is text type.
     */
    public function isText(): bool
    {
        return $this->type === 'text';
    }

    /**
     * Check if material is video type.
     */
    public function isVideo(): bool
    {
        return $this->type === 'video';
    }

    /**
     * Get YouTube embed URL from video URL.
     */
    public function getEmbedUrlAttribute(): ?string
    {
        if (!$this->video_url) {
            return null;
        }

        // Handle various YouTube URL formats
        $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i';
        
        if (preg_match($pattern, $this->video_url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        return $this->video_url;
    }
}
