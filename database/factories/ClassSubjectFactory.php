<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClassSubject>
 */
class ClassSubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subject_name' => fake()->unique()->word(), // e.g., Mathematics
            'subject_code' => fake()->unique()->word(), // e.g., MATH101
            'class_id' => \App\Models\StClass::factory(), // Relationship to StClass model
            'teacher_id' => \App\Models\User::factory(), // Relationship to User model
        ];
    }
}
