<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class NotificationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence,
            'body' => fake()->text,
        ];
    }
}
