<?php

namespace App\Services;

use App\Repositories\VehicleModelRepository;

class VehicleModelService
{
    private $vehicleModelRepository;

    public function __construct(VehicleModelRepository $vehicleModelRepository)
    {
        $this->vehicleModelRepository = $vehicleModelRepository;
    }

    public function createVehicleModel(array $data)
    {
        return $this->vehicleModelRepository->create($data);
    }

    public function updateVehicleModel(int $id, array $data)
    {
        return $this->vehicleModelRepository->update($id, $data);
    }

    public function deleteVehicleModel(int $id)
    {
        return $this->vehicleModelRepository->delete($id);
    }
}
