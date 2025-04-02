<?php

namespace Database\Factories;

use App\Models\StClass;
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
        $startYear = now()->year - rand(0, 4) * 4; // Ensure academic year makes sense
        $endYear = $startYear + 1;

        return [
            'student_id' => Student::factory(),
            'subject_id' => Subject::factory(),
            'class_id' => StClass::factory(),
            'progress_type' => $this->faker->randomElement(['Exam', 'Project', 'Assignment', 'Class Participation', 'Other']),
            'description' => $this->faker->optional()->sentence(),
            'grade' => $this->faker->randomElement(['A', 'B', 'C', 'D', 'E', 'F']),
            'status' => $this->faker->randomElement(['Completed', 'Pending', 'In-Progress']),
            'term' => $this->faker->randomElement(['Term 1', 'Term 2', 'Term 3']),
            'academic_year' => "{$startYear}-{$endYear}",
            'date_recorded' => $this->faker->dateTimeBetween("{$startYear}-01-01", "{$endYear}-12-31")->format('Y-m-d'),
            'teacher_comments' => [
                [
                    'date' => $this->faker->dateTimeBetween("{$startYear}-01-01", "{$endYear}-12-31")->format('Y-m-d'),
                    'comment' => $this->faker->sentence(),
                    'teacher_name' => $this->faker->name(),
                ],
                [
                    'date' => $this->faker->dateTimeBetween("{$startYear}-01-01", "{$endYear}-12-31")->format('Y-m-d'),
                    'comment' => $this->faker->sentence(),
                    'teacher_name' => $this->faker->name(),
                ]
            ],
        ];
    }
}
