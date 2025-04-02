<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\StClass;
use App\Models\Subject;
use App\Models\User;

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
        // Get a random class
        $stClass = StClass::inRandomOrder()->first() ?? StClass::factory()->create();

        // Get a random subject assigned to that class
        $subject = Subject::where('class_id', $stClass->id)->inRandomOrder()->first()
            ?? Subject::factory()->create(['class_id' => $stClass->id]);

        return [
            'subject_name' => $subject->title,
            'subject_code' => strtoupper(substr($subject->title, 0, 4)) . rand(100, 999), // Example: MATH101
            'class_id' => $stClass->id,
            'teacher_id' => User::where('role', 'teacher')->inRandomOrder()->first()?->id
                ?? User::factory()->create(['role' => 'teacher'])->id,
        ];
    }
}
