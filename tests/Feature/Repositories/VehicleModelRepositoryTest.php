<?php

namespace Tests\Feature\Repositories;

use App\Models\VehicleModel;
use App\Repositories\VehicleModelRepository;
use App\Interfaces\RepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VehicleModelRepositoryTest extends TestCase
{  
    private static string $entity = "Model";

    private static function repository():VehicleModelRepository|RepositoryInterface{
        return new VehicleModelRepository;
    } 
    
    // php artisan test --filter=VehicleModelRepositoryTest::test_all_vehicle_models
    public function test_all_vehicle_models(): void
    {
        VehicleModel::factory()->count(5)->create();

        $models = self::repository()->all();

        foreach($models as $model){
            dump($model['id'] . " | " . $model['name']);
        }

        $this->assertNotEmpty($models);
        dump("Total of " . self::$entity. "s: " . $models->count());
    }

    // php artisan test --filter=VehicleModelRepositoryTest::test_create_vehicle_models
    public function test_create_vehicle_models(): void
    {
        $_ = VehicleModel::factory()->make()->toArray();
        
        if(VehicleModelRepository::find($_['id'])){
            $_['id'] .= now()->timestamp;
        }
        $model = self::repository()->create( $_ );
        $this->assertIsInt($model->id);
        $this->assertNotEmpty($model->id);
        dump(self::$entity." created. Id: " . $model->id);
    }

    // php artisan test --filter=VehicleModelRepositoryTest::test_update_vehicle_models
    public function test_update_vehicle_models(): void
    {
        $model = VehicleModel::query()->inRandomOrder()->first(['id', 'name']);
        $result = self::repository()
        ->update($model->id, [ 'name' => str($model->name)->ucfirst()]);
        $this->assertEquals($result, 1);
        dump(self::$entity." updated. Id: " . $model->id);
    }

    // php artisan test --filter=VehicleModelRepositoryTest::test_find_vehicle_model
    public function test_find_vehicle_model(): void
    {
        $model = VehicleModel::query()->inRandomOrder()->first(['id']);
        $model = self::repository()->find($model->id); 
        $this->assertNotEmpty($model->id);
        $this->assertNotEmpty($model->name);
        dump(self::$entity." found. Id: " . $model->id);
    }

    // php artisan test --filter=VehicleModelRepositoryTest::test_delete_vehicle_model
    public function test_delete_vehicle_model(): void
    {
        $model = VehicleModel::query()->orderByDesc('id')->first(['id']);
        $result = self::repository()->delete($model->id);
        $this->assertNotEmpty($result);
        dump(self::$entity." deleted. Id: " . $model->id);
    }


    // php artisan test --filter=VehicleModelRepositoryTest::test_that_vehicle_models_return_paginated
    public function test_that_vehicle_models_return_paginated()
    {  
        $result = self::repository()->allPaginated();
        
        $this->assertInstanceOf(\Illuminate\Contracts\Pagination\Paginator::class, $result);
    }

    // php artisan test --filter=VehicleModelRepositoryTest::test_that_vehicle_models_can_be_ordered_by_and_returned_paginated
    public function test_that_vehicle_models_can_be_ordered_by_and_returned_paginated()
    {   
        $result = self::repository()->orderByPaginated('manufacturing_year', 'desc');

        $p = 2023;

        foreach ($result as $item) {
            dump($item->manufacturing_year);
            $y = $item->manufacturing_year; 
            $this->assertLessThanOrEqual($p, $y); 
            $p = $y;
        }

        $this->assertInstanceOf(\Illuminate\Contracts\Pagination\Paginator::class, $result);
    }

    // php artisan test --filter=VehicleModelRepositoryTest::test_vehicle_models_get_select_options
    public function test_vehicle_models_get_select_options()
    {  
        $result = self::repository()->getOptions();
 
        $this->assertIsArray($result);

        foreach ($result as $item) {
            dump($item);
            $this->assertIsArray($item);
            $this->assertArrayHasKey('label', $item);
            $this->assertArrayHasKey('value', $item);
            $this->assertArrayHasKey('make_id', $item);
        }
    }
}
