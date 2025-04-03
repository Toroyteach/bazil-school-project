<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Validation\Rule;


/**
 * This models represents the students classes.
 * of the school (1 2, pp1, Grade 1 etc)
 */

class StClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_name',
        'section',
        'class_teacher_id',
        'students_count',
    ];

    public function classTeacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'class_teacher_id');
    }

    public function otp(): HasMany
    {
        return $this->HasMany(OTP::class, 'class_id');
    }

    public function subjects(): HasMany
    {
        return $this->HasMany(Subject::class, 'class_id');
    }

    public static function rules()
    {
        return [
            'class_name' => 'required|string|max:255',
            'section' => 'required|string|max:50',
            'students_count' => 'required|integer',
            'class_teacher_id' => 'required|exists:users,id',
        ];
    }
}
