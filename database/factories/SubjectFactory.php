<?php

namespace Database\Factories;

use App\Models\StClass;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Define subjects based on class level
        $subjectsByLevel = [
            'PP1' => ['Language Activities', 'Mathematical Activities', 'Environmental Activities', 'Religious Activities', 'Creative Arts', 'Music', 'Physical Activities'],
            'PP2' => ['Language Activities', 'Mathematical Activities', 'Environmental Activities', 'Religious Activities', 'Creative Arts', 'Music', 'Physical Activities'],
            'Grade 1' => ['English', 'Kiswahili', 'Mathematics', 'Environmental Activities', 'Religious Education', 'Creative Arts', 'Physical and Health Education'],
            'Grade 2' => ['English', 'Kiswahili', 'Mathematics', 'Environmental Activities', 'Religious Education', 'Creative Arts', 'Physical and Health Education'],
            'Grade 3' => ['English', 'Kiswahili', 'Mathematics', 'Environmental Activities', 'Religious Education', 'Creative Arts', 'Physical and Health Education'],
            'Grade 4' => ['English', 'Kiswahili', 'Mathematics', 'Science and Technology', 'Social Studies', 'Religious Education', 'Creative Arts', 'Home Science', 'Agriculture', 'Physical and Health Education', 'ICT'],
            'Grade 5' => ['English', 'Kiswahili', 'Mathematics', 'Science and Technology', 'Social Studies', 'Religious Education', 'Creative Arts', 'Home Science', 'Agriculture', 'Physical and Health Education', 'ICT'],
            'Grade 6' => ['English', 'Kiswahili', 'Mathematics', 'Science and Technology', 'Social Studies', 'Religious Education', 'Creative Arts', 'Home Science', 'Agriculture', 'Physical and Health Education', 'ICT'],
        ];

        // Fetch an existing StClass from the database
        $class = StClass::inRandomOrder()->first();

        // Ensure there's at least one class in the database
        if (!$class) {
            throw new \Exception("No StClass found. Run the StClassSeeder first.");
        }

        $classLevel = $class->class_name; // Get the class name (e.g., 'Grade 1', 'PP1', etc.)
        $subjects = $subjectsByLevel[$classLevel] ?? ['General Subject']; // Get subjects for this class

        return [
            'class_id' => $class->id,
            'title' => fake()->randomElement($subjects),
            'summary' => fake()->sentence(),
            'description' => fake()->paragraph(),
        ];
    }
}
