<?php

namespace Tests\Feature\Repositories;

use App\Models\Vehicle;
use App\Repositories\VehicleRepository;
use App\Interfaces\RepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VehicleRepositoryTest extends TestCase
{  
    private static string $entity = "Vehicle";

    private static function repository():VehicleRepository|RepositoryInterface{
        return new VehicleRepository;
    } 
    
    // php artisan test --filter=VehicleRepositoryTest::test_all_vehicles
    public function test_all_vehicles(): void
    {
        $models = self::repository()->all();

        foreach($models as $model){
            dump($model['id'] . " | " . $model['name']);
        }

        $this->assertNotEmpty($models);
        dump("Total of " . self::$entity. "s: " . $models->count());
    }

    // php artisan test --filter=VehicleRepositoryTest::test_create_vehicles
    public function test_create_vehicles(): void
    {
        $_ = Vehicle::factory()->make()->toArray();
         
        if(VehicleRepository::find($_['id'])){
            $_['id'] .= now()->timestamp;
        }
        $model = self::repository()->create( $_ );
        $this->assertIsInt($model->id);
        $this->assertNotEmpty($model->id);
        dump(self::$entity." created. Id: " . $model->id);
    }

    // php artisan test --filter=VehicleRepositoryTest::test_update_vehicles
    public function test_update_vehicles(): void
    {
        $model = Vehicle::query()->inRandomOrder()->first(['id', 'price']); 
        $result = self::repository()->update($model->id, [ 'price' => $model->price]);
        $this->assertEquals($result, 1);
        dump(self::$entity." updated. Id: " . $model->id);
    }

    // php artisan test --filter=VehicleRepositoryTest::test_find_vehicle
    public function test_find_vehicle(): void
    {
        $model = Vehicle::query()->inRandomOrder()->first(['id']);
        $model = self::repository()->find($model->id); 
        $this->assertNotEmpty($model->id);
        $this->assertNotEmpty($model->price);
        dump(self::$entity." found. Id: " . $model->id);
    }

    // php artisan test --filter=VehicleRepositoryTest::test_delete_vehicle
    public function test_delete_vehicle(): void
    {
        $model = Vehicle::query()->orderByDesc('id')->first(['id']);
        $result = self::repository()->delete($model->id);
        $this->assertNotEmpty($result);
        dump(self::$entity." deleted. Id: " . $model->id);
    }


    // php artisan test --filter=VehicleRepositoryTest::test_that_vehicles_return_paginated
    public function test_that_vehicles_return_paginated()
    {  
        $result = self::repository()->allPaginated();
        
        $this->assertInstanceOf(\Illuminate\Contracts\Pagination\Paginator::class, $result);
    }

    // php artisan test --filter=VehicleRepositoryTest::test_that_vehicles_can_be_ordered_by_and_returned_paginated
    public function test_that_vehicles_can_be_ordered_by_and_returned_paginated()
    {   
        $result = self::repository()->orderByPaginated('price', 'desc');

        $p = PHP_FLOAT_MAX;

        foreach ($result as $item) {
            dump($item->price);
            $c = $item->price; 
            $this->assertLessThanOrEqual($p, $c); 
            $p = $c;
        }

        $this->assertInstanceOf(\Illuminate\Contracts\Pagination\Paginator::class, $result);
    } 
}
