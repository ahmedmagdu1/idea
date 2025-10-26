<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Career extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'location', 'type', 'excerpt', 'body', 'image', 'published_at', 'is_published'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean',
    ];

    public function scopePublished(Builder $q): Builder
    {
        return $q->where('is_published', true)->where(function ($qq) {
            $qq->whereNull('published_at')->orWhere('published_at', '<=', now());
        });
    }
}
