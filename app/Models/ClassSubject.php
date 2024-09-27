<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Validation\Rule;

class ClassSubject extends Model
{
    use HasFactory;

    protected $table = 'class_subjects';

    protected $fillable = [
        'subject_name',
        'subject_code',
        'class_id',
        'teacher_id',
    ];

    public function st_class(): BelongsTo
    {
        return $this->belongsTo(StClass::class, 'class_id');
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public static function rules($id = null)
    {
        return [
            'subject_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('class_subjects', 'subject_name')->ignore($id),
            ],
            'subject_code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('class_subjects', 'subject_code')->ignore($id),
            ],
            'class_id' => 'nullable|exists:st_classes,id',
            'teacher_id' => 'nullable|exists:users,id',
        ];
    }
}
