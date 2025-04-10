<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\StudentAccessController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// // Show OTP request form (optional if using frontend)
// Route::get('/student-access', function () {
//     return view('front.student-details.request-access');
// });

// Submit contact & admission number to receive OTP
Route::post('/student-access/request', [StudentAccessController::class, 'requestAccess'])->name('student.access.request');

// Submit OTP to view student details
Route::post('/student-access/verify', [StudentAccessController::class, 'verifyOtp'])->name('student.access.verify');


Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::get('/student-access', [FrontendController::class, 'student'])->name('student.access');

Route::get('/student/access/details', [StudentAccessController::class, 'showStudentDetails'])->name('student.access.details');

Route::get('/blog', [FrontendController::class, 'blog'])->name('blog.index');
Route::get('/blog/{slug}', [FrontendController::class, 'blogView'])->name('blog.show');