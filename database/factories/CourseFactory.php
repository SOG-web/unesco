<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->unique()->jobTitle(),
            'duration' => '50 min',
            'thumbnail'=> fake()->imageUrl(),
            'date' => fake()->date(),
            'time' => fake()->time(),
            'type' => $this->randomPick(),
            'video_url' => fake()->imageUrl(),
            'audio_url' => fake()->imageUrl(),
            'link' => fake()->url(),
            'slug' => fake()->unique()->slug(),
            'description' => fake()->paragraph()
        ];
    }

    function randomPick(): string
    {
        // random pick between 'course' and 'other'
        $types = ['audio', 'video', 'link'];
        return $types[array_rand($types)];
    }
}
