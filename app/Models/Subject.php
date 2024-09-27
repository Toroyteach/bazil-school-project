<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Validation\Rule;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'title',
        'summary',
        'description'
    ];

    public function st_class(): BelongsTo
    {
        return $this->belongsTo(StClass::class, 'class_id');
    }

    public static function rules()
    {
        return [
            'title' => 'required|string|max:100',
            'summary' => 'required|string|max:500',
            'description' => 'nullable|string',
            'class_id' => 'required|exists:st_classes,id',
        ];
    }
}
