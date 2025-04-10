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
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
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
            return response()->json([
                'success' => false,
                'message' => 'Contact does not match any Details.'
            ], 403);
        }

        try {
            $service = new StudentAccessService();
            $response = $service->generateOtpForContact($contact, $admissionNumber);

            if (isset($response['error'])) {
                return response()->json([
                    'success' => false,
                    'message' => $response['error']
                ], 500);
            }

            return response()->json([
                'success' => true,
                'message' => $response['message']
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to send OTP. Try again.');
        }
    }

    public function verifyOtp(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['success' => false, 'message' => 'Invalid request.'], 400);
        }

        $data = $request->only(['otp', 'contact', 'admission_number']);

        $validator = Validator::make($data, [
            'otp' => 'required|string',
            'contact' => 'required|string',
            'admission_number' => 'required|string|exists:students,admission_number',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        try {
            $service = new StudentAccessService();
            $studentData = $service->verifyOtpAndFetchData($data['contact'], $data['otp']);

            // store data in session so the view route can use it
            session()->flash('student_data', $studentData);

            return response()->json([
                'success' => true,
                'message' => 'OTP verified. Redirecting...',
                'redirect' => route('student.access.details')
            ]);

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function showStudentDetails(Request $request)
    {
        $studentData = $request->session()->get('student_data');

        if (!$studentData) {
            return back()->with('error', 'Student data not found.');
        }

        return view('front.student-details.student-details', $studentData);
    }
}