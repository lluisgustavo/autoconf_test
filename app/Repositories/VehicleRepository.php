<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Vehicle;  
use Illuminate\Contracts\Pagination\Paginator;  

class VehicleRepository extends AbstractRepository
{
    protected static $model = Vehicle::class;

    public function allPaginated($perPage = 10): Paginator
    {
        return $this->loadModel()::paginate($perPage);
    }
 
    public function orderByPaginated($column = 'id', $direction = 'asc', $perPage = 10): Paginator
    {  
        if ($column == 'make') {
            return $this->loadModel()::with(['make', 'model'])
                ->join('makes', 'makes.id', '=', 'vehicles.make_id')
                ->orderBy("makes.name", $direction)
                ->select('vehicles.*') 
                ->paginate($perPage);
        } 

        if ($column == 'model') {
            return $this->loadModel()::with(['make', 'model'])
                ->join('vehicle_models', 'vehicle_models.id', '=', 'vehicles.vehicle_model_id')
                ->orderBy("vehicle_models.name", $direction)
                ->select('vehicles.*') 
                ->paginate($perPage);
        } 

        return $this->loadModel()::with(['make', 'model'])->orderBy($column, $direction)->paginate($perPage);
    }
}