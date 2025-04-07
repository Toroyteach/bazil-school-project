<?php

use App\Http\Controllers\StudentAccessController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Show OTP request form (optional if using frontend)
Route::get('/student-access', function () {
    return view('front.student-details.request-access');
});

// Submit contact & admission number to receive OTP
Route::post('/student-access/request', [StudentAccessController::class, 'requestAccess'])->name('student.access.request');

// Submit OTP to view student details
Route::post('/student-access/verify', [StudentAccessController::class, 'verifyOtp'])->name('student.access.verify');
