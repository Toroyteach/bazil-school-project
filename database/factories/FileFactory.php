<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\File>
 */
class FileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fileable_type' => Post::class,
            'fileable_id' => Post::factory(),
            'path' => 'uploads/' . $this->faker->uuid . '.jpg',
            'type' => $this->faker->randomElement(['image', 'video', 'document']),
        ];
    }
}
