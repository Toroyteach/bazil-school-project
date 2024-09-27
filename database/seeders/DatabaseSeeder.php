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

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        PaymentMethod::factory()->count(4)->create();
        User::factory()->count(50)->create(); // 200 users

        StClass::factory()->count(50)->create(); // 50 classes
        Subject::factory()->count(20)->create(); // 100 subjects

        ClassSubject::factory()->count(30)->create(); // 200 class-subject relations

        Student::factory()->count(1000)->create(); // 1000 students
        SchoolFee::factory()->count(500)->create(); // 1000 school fees

        OTP::factory()->count(700)->create(); // 1000 OTP records

        AcademicProgress::factory()->count(500)->create(); // 1000 academic progress records
    }
}
