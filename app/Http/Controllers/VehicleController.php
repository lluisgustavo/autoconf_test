<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use App\Models\Vehicle;
use App\Repositories\MakeRepository;
use App\Repositories\VehicleModelRepository;
use App\Repositories\VehicleRepository;
use App\Services\ImageUploadService;
use App\Services\VehicleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class VehicleController extends Controller
{
    private $vehicleService;

    private $imageUploadService;

    private $vehicleRepository;

    private $vehicleModelRepository;

    private $makeRepository;

    public function __construct(
        ImageUploadService $imageUploadService,
        VehicleService $vehicleService,
        VehicleRepository $vehicleRepository,
        VehicleModelRepository $vehicleModelRepository,
        MakeRepository $makeRepository)
    {
        $this->imageUploadService = $imageUploadService;
        $this->vehicleService = $vehicleService;
        $this->vehicleRepository = $vehicleRepository;
        $this->vehicleModelRepository = $vehicleModelRepository;
        $this->makeRepository = $makeRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $column = $request->get('column', 'id');
        $direction = $request->get('direction', 'asc');
        $vehicles = $this->vehicleRepository->orderByPaginated($column, $direction);

        return Inertia::render('Vehicles/Index', [
            'vehicles' => $vehicles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $makesOptions = $this->makeRepository->getOptions();
        $vehicleModelsOptions = $this->vehicleModelRepository->getOptions();

        return Inertia::render('Vehicles/Create', [
            'makesOptions' => $makesOptions,
            'vehicleModelsOptions' => $vehicleModelsOptions,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVehicleRequest $request)
    {
        $data = $request->validated();

        $imageFile = $request->file('image_path');

        if (isset($imageFile)) {
            $data['image_path'] = $this->imageUploadService->uploadImage($imageFile);
            $vehicle = $this->vehicleService->createVehicle($data);
        }

        return redirect()->route('veiculos.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $veiculo)
    {
        $makesOptions = $this->makeRepository->getOptions();
        $vehicleModelsOptions = $this->vehicleModelRepository->getOptions();

        return Inertia::render('Vehicles/Edit', [
            'vehicle' => $veiculo,
            'makesOptions' => $makesOptions,
            'vehicleModelsOptions' => $vehicleModelsOptions,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVehicleRequest $request, Vehicle $veiculo)
    {
        $data = $request->validated();

        if ($request->hasFile('image_path')) {
            Storage::disk('public')->delete($veiculo->image_path);
            $data['image_path'] = $this->imageUploadService->uploadImage($request->file('image_path'));
        }

        $vehicle = $this->vehicleService->updateVehicle($veiculo->id, $data);

        return redirect()->route('veiculos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $veiculo)
    {
        $this->vehicleRepository->delete($veiculo->id);

        return redirect()->route('veiculos.index');
    }
}
