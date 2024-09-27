<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Validation\Rule;

class StClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_name',
        'section',
        'class_teacher_id',
    ];

    public function classTeacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'class_teacher_id');
    }

    public static function rules()
    {
        return [
            'class_name' => 'required|string|max:255',
            'section' => 'required|string|max:50',
        ];
    }
}
