<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Validation\Rule;

class AcademicProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'subject_id',
        'progress_type',
        'description',
        'grade',
        'status',
        'term',
        'academic_year',
        'date_recorded',
        'teacher_comments',
    ];

    protected $casts = [
        'date_recorded' => 'date',
        'progress_type' => 'string',
        'status' => 'string',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public static function rules($id = null)
    {
        return [
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'progress_type' => [
                'required',
                'string',
                Rule::in(['Exam', 'Project', 'Assignment', 'Class Participation', 'Other']),
            ],
            'description' => 'nullable|string',
            'grade' => 'nullable|string|max:10',
            'status' => [
                'required',
                'string',
                Rule::in(['Completed', 'Pending', 'In-Progress']),
            ],
            'term' => 'required|string|max:50',
            'academic_year' => 'required|string|max:20',
            'date_recorded' => 'required|date',
            'teacher_comments' => 'nullable|string',
        ];
    }
}
