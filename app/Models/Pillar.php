<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pillar extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'color',
        'order',
    ];

    /**
     * Get all materials for this pillar.
     */
    public function materials(): HasMany
    {
        return $this->hasMany(Material::class)->orderBy('order');
    }

    /**
     * Get the quiz for this pillar.
     */
    public function quiz(): HasOne
    {
        return $this->hasOne(Quiz::class);
    }

    /**
     * Get text materials for this pillar.
     */
    public function textMaterials(): HasMany
    {
        return $this->hasMany(Material::class)->where('type', 'text')->orderBy('order');
    }

    /**
     * Get video materials for this pillar.
     */
    public function videoMaterials(): HasMany
    {
        return $this->hasMany(Material::class)->where('type', 'video')->orderBy('order');
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
