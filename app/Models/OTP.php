<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OTP extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone_number',
        'otp_code',
        'expires_at',
        'is_verified',
        'student_id',
        'class_id'
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function stClass(): BelongsTo
    {
        return $this->belongsTo(StClass::class, 'class_id');
    }
}
