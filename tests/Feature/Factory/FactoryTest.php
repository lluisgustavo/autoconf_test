<?php

namespace Tests\Feature\Factory;

use App\Models\Make;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use Tests\TestCase;

class FactoryTest extends TestCase
{
    /**
     * php artisan test --filter test_main
     */
    public function test_main(): void
    {
        try {
            $initialUserCount = User::query()->count();
            User::factory(5)->create();
            $finalUserCount = User::query()->count();
        } catch (\Throwable $th) {
            dump($th->getMessage());
        }

        try {
            $initialMakeCount = Make::query()->count();
            Make::factory(5)->create();
            $finalMakeCount = Make::query()->count();
        } catch (\Throwable $th) {
            dump($th->getMessage());
        }

        try {
            $initialVehicleModelCount = VehicleModel::query()->count();
            VehicleModel::factory(5)->create();
            $finalVehicleModelCount = VehicleModel::query()->count();
        } catch (\Throwable $th) {
            dump($th->getMessage());
        }

        try {
            $initialVehicleCount = Vehicle::query()->count();
            Vehicle::factory(5)->create();
            $finalVehicleCount = Vehicle::query()->count();
        } catch (\Throwable $th) {
            dump($th->getMessage());
        }

        dump(
            'Users: '.User::query()->count(),
            'Makes: '.Make::query()->count(),
            'Models: '.Make::query()->count(),
            'Vehicles: '.Make::query()->count(),
        );

        $this->assertEquals($initialUserCount + 5, $finalUserCount, 'Expected user count to increase by 5.');
        $this->assertEquals($initialMakeCount + 5, $finalMakeCount, 'Expected makes count to increase by 5.');
        $this->assertEquals($initialVehicleModelCount + 5, $finalVehicleModelCount, 'Expected models count to increase by 5.');
        $this->assertEquals($initialVehicleCount + 5, $finalVehicleCount, 'Expected vehicles count to increase by 5.');
    }
}
