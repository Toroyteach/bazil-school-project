<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'is_active' => 'boolean',
        'meta' => 'array',
    ];

    protected $fillable = [
        'title', 'slug', 'description', 'type',
        'starts_at', 'ends_at', 'status',
        'author_id', 'is_active', 'meta',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function attendees()
    {
        return $this->belongsToMany(User::class, 'post_user');
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('ends_at')
                  ->orWhere('ends_at', '>', now());
            });
    }
}
