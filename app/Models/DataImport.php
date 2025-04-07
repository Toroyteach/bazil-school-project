<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataImport extends Model
{
    /** @use HasFactory<\Database\Factories\DataImportFactory> */
    use HasFactory;

    protected $fillable = ['file_path', 'status'];
}
