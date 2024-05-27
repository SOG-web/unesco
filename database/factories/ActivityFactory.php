<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Activity>
 */
class ActivityFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->title,
            'content' => fake()->paragraph(),
            'status' => 'unread',
            'type' => $this->randomPick(),
            'user_id' => User::factory(),
        ];
    }

    function randomPick(): string
    {
        // random pick between 'course' and 'other'
        $types = ['course', 'other'];
        return $types[array_rand($types)];
    }
}
