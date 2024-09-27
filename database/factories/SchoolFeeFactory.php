<?php

namespace Database\Factories;

use App\Models\PaymentMethod;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SchoolFee>
 */
class SchoolFeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => Student::factory(), // Create a related student
            'amount_due' => fake()->randomFloat(2, 100, 1000), // Example range
            'amount_paid' => fake()->randomFloat(2, 0, 1000), // Example range
            'balance' => fake()->randomFloat(2, 0, 1000), // Example range
            'status' => fake()->randomElement(['Paid', 'Partial', 'Unpaid']),
            'due_date' => fake()->date(),
            'payment_method_id' => PaymentMethod::factory(), // Create a related payment method
            'remarks' => fake()->sentence(),
        ];
    }
}
