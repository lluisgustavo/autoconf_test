<?php

namespace Tests\Feature\Repositories;

use App\Models\Make;
use App\Repositories\MakeRepository;
use App\Interfaces\RepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MakeRepositoryTest extends TestCase
{  
    private static string $entity = "Make";

    private static function repository():MakeRepository|RepositoryInterface{
        return new MakeRepository;
    } 
    
    // php artisan test --filter=MakeRepositoryTest::test_all_makes
    public function test_all_makes(): void
    {
        $models = self::repository()->all();

        foreach($models as $model){
            dump($model['id'] . " | " . $model['name']);
        }

        $this->assertNotEmpty($models);
        dump("Total of " . self::$entity. "s: " . $models->count());
    }

    // php artisan test --filter=MakeRepositoryTest::test_create_makes
    public function test_create_makes(): void
    {
        $_ = Make::factory()->make()->toArray();
        
        if(MakeRepository::find($_['id'])){
            $_['id'] .= now()->timestamp;
        }
        $model = self::repository()->create( $_ );
        $this->assertIsInt($model->id);
        $this->assertNotEmpty($model->id);
        dump(self::$entity." created. Id: " . $model->id);
    }

    // php artisan test --filter=MakeRepositoryTest::test_update_makes
    public function test_update_makes(): void
    {
        $model = Make::query()->inRandomOrder()->first(['id', 'name']);
        $result = self::repository()
        ->update($model->id, [ 'name' => str($model->name)->ucfirst()]);
        $this->assertEquals($result, 1);
        dump(self::$entity." updated. Id: " . $model->id);
    }

    // php artisan test --filter=MakeRepositoryTest::test_find_make
    public function test_find_makes(): void
    {
        $model = Make::query()->inRandomOrder()->first(['id']);
        $model = self::repository()->find($model->id); 
        $this->assertNotEmpty($model->id);
        $this->assertNotEmpty($model->name);
        dump(self::$entity." found. Id: " . $model->id);
    }

    // php artisan test --filter=MakeRepositoryTest::test_delete_make
    public function test_delete_make(): void
    {
        $model = Make::query()->orderByDesc('id')->first(['id']);
        $result = self::repository()->delete($model->id);
        $this->assertNotEmpty($result);
        dump(self::$entity." deleted. Id: " . $model->id);
    }


    // php artisan test --filter=MakeRepositoryTest::test_that_makes_return_paginated
    public function test_that_makes_return_paginated()
    {  
        $result = self::repository()->allPaginated();
        
        $this->assertInstanceOf(\Illuminate\Contracts\Pagination\Paginator::class, $result);
    }

    // php artisan test --filter=MakeRepositoryTest::test_that_makes_can_be_ordered_by_and_returned_paginated
    public function test_that_makes_can_be_ordered_by_and_returned_paginated()
    {   
        $result = self::repository()->orderByPaginated('founding_year', 'desc');

        $p = 2023;

        foreach ($result as $item) {
            dump($item->founding_year);
            $y = $item->founding_year; 
            $this->assertLessThanOrEqual($p, $y); 
            $p = $y;
        }

        $this->assertInstanceOf(\Illuminate\Contracts\Pagination\Paginator::class, $result);
    }

    // php artisan test --filter=MakeRepositoryTest::test_makes_get_select_options
    public function test_makes_get_select_options()
    {  
        $result = self::repository()->getOptions();
 
        $this->assertIsArray($result);

        foreach ($result as $item) {
            dump($item);
            $this->assertIsArray($item);
            $this->assertArrayHasKey('label', $item);
            $this->assertArrayHasKey('value', $item);
        }
    }
}
