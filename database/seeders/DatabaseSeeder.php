<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\StClass;
use App\Models\Subject;
use App\Models\ClassSubject;
use App\Models\SchoolFee;
use App\Models\OTP;
use App\Models\PaymentMethod;
use App\Models\AcademicProgress;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Basil Kasa Amigo',
            'email' => 'basil-admin@thecraneschool.sc.ke',
            'password' => Hash::make('password123'),
            'phone_number' => '1234567890',
            'address' => '123 Main St',
            'city' => 'Nairobi',
            'state' => 'Nairobi',
            'country' => 'Kenya',
            'postal_code' => '00100',
            'role' => 'admin',
        ]);

        // PaymentMethod::factory()->count(4)->create();
        User::factory()->count(25)->create(); // 200 users


        // Ensure unique class names
        $classNames = [
            'PP1',
            'PP2',
            'Grade 1',
            'Grade 2',
            'Grade 3',
            'Grade 4',
            'Grade 5',
            'Grade 6'
        ];

        foreach ($classNames as $className) {
            StClass::factory()->create(['class_name' => $className, 'students_count' => 0]);
        }

        // Create subjects assigned to classes
        $classes = StClass::all();
        foreach ($classes as $class) {
            $subjectsByLevel = [
                'PP1' => ['Language Activities', 'Mathematical Activities', 'Environmental Activities'],
                'PP2' => ['Language Activities', 'Mathematical Activities', 'Environmental Activities'],
                'Grade 1' => ['English', 'Kiswahili', 'Mathematics'],
                'Grade 2' => ['English', 'Kiswahili', 'Mathematics'],
                'Grade 3' => ['English', 'Kiswahili', 'Mathematics'],
                'Grade 4' => ['English', 'Kiswahili', 'Mathematics', 'Science and Technology'],
                'Grade 5' => ['English', 'Kiswahili', 'Mathematics', 'Science and Technology'],
                'Grade 6' => ['English', 'Kiswahili', 'Mathematics', 'Science and Technology'],
            ];

            foreach ($subjectsByLevel[$class->class_name] ?? [] as $subjectTitle) {
                Subject::factory()->create([
                    'title' => $subjectTitle,
                    'class_id' => $class->id,
                ]);
            }
        }

        // Create ClassSubject without duplicates per class
        foreach ($classes as $class) {
            $subjects = Subject::where('class_id', $class->id)->get();
            foreach ($subjects as $subject) {
                ClassSubject::factory()->create([
                    'class_id' => $class->id,
                    'subject_name' => $subject->title,
                    'subject_code' => strtoupper(substr($subject->title, 0, 4)) . rand(100, 999),
                    'teacher_id' => User::where('role', 'teacher')->inRandomOrder()->first()?->id,
                ]);
            }
        }

        // Assign students to classes and update students_count
        Student::factory()->count(500)->create()->each(function ($student) {
            $class = StClass::inRandomOrder()->first();
            $student->class_id = $class->id;
            $student->save();

            // Increment students_count
            $class->increment('students_count');

            // Assign academic progress for the student
            $studentSbjects = Subject::where('class_id', $class->id)->get();
            foreach ($studentSbjects as $subject) {
                AcademicProgress::factory()->create([
                    'student_id' => $student->id,
                    'subject_id' => $subject->id,
                    'class_id' => $class->id,
                ]);
            }

            // Assign multiple school fee records (between 4 and 10)
            $numPayments = rand(4, 10);
            SchoolFee::factory()->count($numPayments)->create([
                'student_id' => $student->id,
                'class_id' => $class->id,
                'payment_method_id' => PaymentMethod::factory()->create()->id,
            ]);
        });

        OTP::factory()->count(1000)->create(); // 1000 OTP records
    }
}
