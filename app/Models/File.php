<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /** @use HasFactory<\Database\Factories\FileFactory> */
    use HasFactory;
    
    protected $fillable = ['fileable_type', 'fileable_id', 'path', 'type'];

    public function fileable()
    {
        return $this->morphTo();
    }

    public function getUrlAttribute()
    {
        return asset('storage/' . $this->path);
    }
}
