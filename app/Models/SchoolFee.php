<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Validation\Rule;

class SchoolFee extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'amount_due',
        'amount_paid',
        'balance',
        'status',
        'due_date',
        'payment_method_id',
        'remarks',
    ];

    protected $casts = [
        'amount_due' => 'decimal:2',
        'amount_paid' => 'decimal:2',
        'balance' => 'decimal:2',
        'due_date' => 'date',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }

    public static function rules($id = null)
    {
        return [
            'student_id' => 'required|exists:students,id',
            'amount_due' => 'required|numeric|between:0,999999.99',
            'amount_paid' => 'required|numeric|between:0,999999.99',
            'balance' => 'required|numeric|between:0,999999.99',
            'status' => ['required', 'string', Rule::in(['Paid', 'Partial', 'Unpaid'])],
            'due_date' => 'required|date',
            'payment_method_id' => 'nullable|exists:payment_methods,id',
            'remarks' => 'nullable|string',
        ];
    }
}
