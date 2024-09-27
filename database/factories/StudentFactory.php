<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'middle_name' => fake()->optional()->firstName(),
            'last_name' => fake()->lastName(),
            'gender' => fake()->randomElement(['Male', 'Female', 'Other']),
            'dob' => fake()->date(),
            'address' => fake()->optional()->streetAddress(),
            'city' => fake()->city(),
            'state' => fake()->state(),
            'country' => fake()->country(),
            'postal_code' => fake()->optional()->postcode(),
            'parent_phone_1' => fake()->phoneNumber(),
            'parent_phone_2' => fake()->phoneNumber(),
            'parent_email_1' => fake()->optional()->safeEmail(),
            'parent_email_2' => fake()->optional()->safeEmail(),
            'admission_date' => fake()->date(),
            'admission_number' => fake()->asciify('*********'),
            'class_id' => \App\Models\StClass::factory(),
            'section' => fake()->optional()->word(),
            'emergency_contact_name' => fake()->name(),
            'emergency_contact_phone' => fake()->phoneNumber(),
            'profile_photo' => fake()->optional()->imageUrl(),
        ];
    }
}
