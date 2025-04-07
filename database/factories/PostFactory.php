<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence;
        return [
            'title' => $title,
            'slug' => Str::slug($title) . '-' . Str::random(4),
            'description' => $this->faker->paragraph,
            'type' => $this->faker->randomElement(['event', 'blog', 'story']),
            'status' => $this->faker->randomElement(['draft', 'published', 'archived']),
            'is_active' => $this->faker->boolean(80),
            'starts_at' => $this->faker->optional()->dateTimeBetween('now', '+5 days'),
            'ends_at' => $this->faker->optional()->dateTimeBetween('+5 days', '+10 days'),
            'author_id' => User::factory(),
            'meta' => [
                'video_link' => $this->faker->optional()->url,
            ],
        ];
    }
}
