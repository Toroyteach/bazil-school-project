<?php

namespace App\Http\Controllers;

use App\Models\OTP;
use App\Models\Student;
use App\Services\StudentAccessService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentAccessController extends Controller
{
    public function requestAccess(Request $request)
    {
        $data = $request->only(['contact', 'admission_number']);

        $validator = Validator::make($data, [
            'contact' => 'required|string',
            'admission_number' => 'required|string|exists:students,admission_number',
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Please enter a valid contact and admission number.');
        }

        $contact = $data['contact'];
        $admissionNumber = $data['admission_number'];

        $student = Student::where('admission_number', $admissionNumber)->first();

        $isValid = false;

        if (filter_var($contact, FILTER_VALIDATE_EMAIL)) {
            $isValid = in_array($contact, [$student->parent_email_1, $student->parent_email_2]);
        } elseif (preg_match('/^\+?\d{7,15}$/', $contact)) {
            $isValid = in_array($contact, [$student->parent_phone_1, $student->parent_phone_2]);
        }

        if (!$isValid) {
            return back()->with('error', 'Contact does not match any parent contact for this student.');
        }

        try {
            $service = new StudentAccessService();
            $response = $service->generateOtpForContact($contact, $admissionNumber);

            if (isset($response['error'])) {
                return back()->with('error', $response['error']);
            }

            return back()->with([
                'success' => $response['message'],
                'show_otp_form' => true,
                'contact' => $contact
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to send OTP. Try again.');
        }
    }

    public function verifyOtp(Request $request)
    {
        $data = $request->only(['otp', 'contact']);

        $validator = Validator::make($data, [
            'otp' => 'required|string',
            'contact' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'OTP or contact is invalid.');
        }

        try {
            $service = new StudentAccessService();
            $studentData = $service->verifyOtpAndFetchData($data['contact'], $data['otp']);

            if (isset($studentData['error'])) {
                return back()->with('error', $studentData['error']);
            }

            return view('front.student-details.student-details', $studentData);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}