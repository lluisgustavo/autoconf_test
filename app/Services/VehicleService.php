<?php 

namespace App\Services;

use App\Repositories\VehicleRepository;
use App\Models\Vehicle;

class VehicleService
{
    private $vehicleRepository;

    public function __construct(VehicleRepository $vehicleRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
    }

    public function createVehicle(array $data)
    { 
        return $this->vehicleRepository->create($data);
    }
    public function updateVehicle(int $id, array $data)
    { 
        return $this->vehicleRepository->update($id, $data);
    }

    public function deleteVehicle(int $id)
    { 
        return $this->vehicleRepository->delete($id);
    }
}