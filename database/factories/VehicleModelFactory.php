<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VehicleModel>
 */
class VehicleModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $makesIDs = DB::table('makes')->pluck('id');

        return [
            'id' => fake()->unique()->randomNumber(),
            'make_id' => fake()->randomElement($makesIDs),
            'name' => fake()->unique()->name(),
            'manufacturing_year' => fake()->numberBetween(1800, 2023),
            'fuel_type' => fake()->randomElement(['Gasolina', 'Diesel', 'Elétrico', 'Híbrido', 'GNV', 'Flex', 'Etanol', 'Outros']),
            'type' => fake()->randomElement(['Carro', 'Motocicleta', 'Caminhão', 'Outro']),
        ];
    }
}
