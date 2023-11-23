<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Make>
 */
class MakeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->unique()->randomNumber(),
            'name' => fake()->unique()->name(),
            'description' => fake()->words(255, true),
            'founding_year' => fake()->numberBetween(1800, 2023),
            'country_of_origin' => fake()->country(),
        ];
    }
}
