<?php

namespace Database\Factories;

use App\Models\StClass;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OTP>
 */
class OTPFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'phone_number' => fake()->phoneNumber(),
            'otp_code' => fake()->numberBetween(100000, 999999),
            'expires_at' => fake()->dateTimeBetween('now', '+1 hour'),
            'is_verified' => fake()->boolean(),
            'student_id' => Student::inRandomOrder()->first()?->id ?? Student::factory(),
            'class_id' => StClass::inRandomOrder()->first()?->id ?? StClass::factory(),
        ];
    }
}
