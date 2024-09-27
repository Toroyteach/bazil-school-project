<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StClass>
 */
class StClassFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'class_name' => fake()->word(), // Example class name
            'section' => fake()->optional()->word(), // Optional section
            'class_teacher_id' => User::factory(), // Create a related class teacher
        ];
    }
}
