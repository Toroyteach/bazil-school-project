<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;
use App\Models\Subject;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AcademicProgress>
 */
class AcademicProgressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => Student::factory(),
            'subject_id' => Subject::factory(),
            'progress_type' => $this->faker->randomElement(['Exam', 'Project', 'Assignment', 'Class Participation', 'Other']),
            'description' => $this->faker->optional()->paragraph(),
            'grade' => $this->faker->optional()->word(),
            'status' => $this->faker->randomElement(['Completed', 'Pending', 'In-Progress']),
            'term' => $this->faker->word(), // e.g., Term 1, Term 2
            'academic_year' => $this->faker->year() . '-' . ($this->faker->year() + 1), // e.g., 2023-2024
            'date_recorded' => $this->faker->date(),
            'teacher_comments' => $this->faker->optional()->paragraph(),
        ];
    }
}
