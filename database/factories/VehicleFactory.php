<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $vehicleModels = DB::table('vehicle_models')->pluck('id', 'make_id')->toArray();

        return [
            'id' => fake()->unique()->randomNumber(),
            'make_id' => fake()->randomElement(array_keys($vehicleModels)),
            'vehicle_model_id' => fake()->randomElement($vehicleModels),
            'price' => fake()->randomFloat(2, 10000, 50000),
            'image_path' => fake()->imageUrl(),
        ];
    }
}
