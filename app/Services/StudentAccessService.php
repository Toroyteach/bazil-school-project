<?php

namespace App\Services;

use App\Models\OTP;
use App\Models\Student;
use App\Models\SchoolFee;
use App\Models\AcademicProgress;
use Illuminate\Support\Facades\Log;
use App\Mail\SendParentOtpMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Exception;

class StudentAccessService
{
    public function generateOtpForContact(string $contact, string $admissionNumber)
    {
        try {
            $student = Student::where(function ($q) use ($contact) {
                $q->where('parent_email_1', $contact)
                    ->orWhere('parent_email_2', $contact)
                    ->orWhere('parent_phone_1', $contact)
                    ->orWhere('parent_phone_2', $contact);
            })->where('admission_number', $admissionNumber)->firstOrFail();
        } catch (Exception $e) {
            throw new Exception('No matching student with that contact.');
        }

        try {
            $existingOtp = OTP::where(function ($q) use ($contact) {
                $q->where('phone_number', $contact)
                    ->orWhere('send_email', $contact);
            })
                ->where('student_id', $student->id)
                ->where('created_at', '>=', now()->subMinutes(30))
                ->latest()
                ->first();

            if ($existingOtp) {
                $channel = filter_var($contact, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
                return [
                    'message' => "An OTP was already sent to your {$channel} within the last 30 minutes. Please check and reuse it."
                ];
            }

            $otpCode = rand(100000, 999999);
            OTP::create([
                'phone_number' => preg_match('/^\+?\d{7,15}$/', $contact) ? $contact : null,
                'send_email' => filter_var($contact, FILTER_VALIDATE_EMAIL) ? $contact : null,
                'otp_code' => $otpCode,
                'expires_at' => now()->addMinutes(30),
                'is_verified' => false,
                'student_id' => $student->id,
                'class_id' => $student->class_id,
            ]);

            $message = "Dear Parent/Guardian, your OTP to access info for {$student->first_name} {$student->last_name} is: {$otpCode}";

            if (filter_var($contact, FILTER_VALIDATE_EMAIL)) {

                Mail::to($contact)->send(new SendParentOtpMail(
                    studentName: "{$student->first_name} {$student->last_name}",
                    otp: $otpCode,
                ));

            } elseif (preg_match('/^\+?\d{7,15}$/', $contact)) {
                $response = Http::post('https://sms-provider.com/api/send', [
                    'to' => $contact,
                    'message' => $message,
                ]);

                if (!$response->successful()) {
                    throw new Exception('Failed to send OTP via SMS.');
                }
            } else {
                throw new Exception('Invalid contact format.');
            }

            return ['message' => 'OTP sent to your Contact'];

        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function verifyOtpAndFetchData(string $contact, string $otp)
    {
        try {
            $record = OTP::where('otp_code', $otp)
                ->where('expires_at', '>', now())
                ->latest()
                ->first();

            if (!$record) {
                return ['error' => 'Invalid or expired OTP.'];
            }

            
            $record->update(['is_verified' => true]);
            
            $student = Student::with(['st_class', 'schoolFees', 'academicProgress'])->findOrFail($record->student_id);
            
            return [
                'student' => $student,
                'fees' => $student->schoolFees,
                'progress' => $student->academicProgress->groupBy('term'),
            ];
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}