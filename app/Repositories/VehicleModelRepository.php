<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\VehicleModel;  
use Illuminate\Contracts\Pagination\Paginator;

class VehicleModelRepository extends AbstractRepository
{
    protected static $model = VehicleModel::class;

    public function allPaginated($perPage = 10): Paginator
    {
        return $this->loadModel()::paginate($perPage);
    }
 
    public function orderByPaginated($column = 'id', $direction = 'asc', $perPage = 10): Paginator
    {
        if ($column == 'make') {
            return $this->loadModel()::with('make')
                ->join('makes', 'makes.id', '=', 'vehicle_models.make_id')
                ->orderBy("makes.name", $direction)
                ->select('vehicle_models.*') 
                ->paginate($perPage);
        } 
    
        return $this->loadModel()::with('make')->orderBy($column, $direction)->paginate($perPage);
    }

    public function getOptions()
    {
        $vehicleModels = $this->loadModel()::all(); 

        $options = $vehicleModels->map(function ($vehicleModel) {
            return [
                'label' => $vehicleModel->name,
                'value' => (string) $vehicleModel->id,
                'make_id' => (string) $vehicleModel->make->id,
            ];
        });

        return $options->toArray();
    }
}