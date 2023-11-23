<?php

namespace App\Services;

use App\Repositories\MakeRepository;

class MakeService
{
    private $makeRepository;

    public function __construct(MakeRepository $makeRepository)
    {
        $this->makeRepository = $makeRepository;
    }

    public function createMake(array $data)
    {
        return $this->makeRepository->create($data);
    }

    public function updateMake(int $id, array $data)
    {
        return $this->makeRepository->update($id, $data);
    }

    public function deleteMake(int $id)
    {
        return $this->makeRepository->delete($id);
    }
}
