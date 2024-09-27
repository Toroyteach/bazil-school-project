<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Validation\Rule;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'dob',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'parent_phone_1',
        'parent_phone_2',
        'parent_email_1',
        'parent_email_2',
        'admission_date',
        'admission_number',
        'class_id',
        'section',
        'emergency_contact_name',
        'emergency_contact_phone',
        'profile_photo',
    ];

    protected $casts = [
        'dob' => 'date',
        'admission_date' => 'date',
    ];

    public function st_class(): BelongsTo
    {
        return $this->belongsTo(StClass::class, 'class_id');
    }

    public static function rules($id = null)
    {
        return [
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => ['required', 'string', Rule::in(['Male', 'Female', 'Other'])],
            'dob' => 'required|date',
            'address' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'parent_phone_1' => 'required|string|max:15',
            'parent_phone_2' => 'nullable|string|max:15',
            'parent_email_1' => 'nullable|email|max:255',
            'parent_email_2' => 'nullable|email|max:255',
            'admission_date' => 'required|date',
            'admission_number' => [
                'required',
                'string',
                'max:255',
                Rule::unique('students', 'admission_number')->ignore($id),
            ],
            'class_id' => 'nullable|exists:st_classes,id',
            'section' => 'nullable|string|max:50',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_phone' => 'required|string|max:15',
            'profile_photo' => 'nullable|string|max:255', // Assuming URL or file path
        ];
    }
}
