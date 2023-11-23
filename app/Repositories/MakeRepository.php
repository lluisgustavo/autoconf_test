<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Make;  
use Illuminate\Contracts\Pagination\Paginator;

class MakeRepository extends AbstractRepository
{
    protected static $model = Make::class;

    public function allPaginated($perPage = 10): Paginator
    {
        return $this->loadModel()::paginate($perPage);
    }
 
    public function orderByPaginated($column = 'id', $direction = 'asc', $perPage = 10): Paginator
    {
        return $this->loadModel()::orderBy($column, $direction)->paginate($perPage);
    }
    public function getOptions()
    {
        $makes = $this->loadModel()::all(); 

        $options = $makes->map(function ($make) {
            return [
                'label' => $make->name,
                'value' => (string) $make->id,
            ];
        });

        return $options->toArray();
    }
}