<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVehicleModelRequest;
use App\Http\Requests\UpdateVehicleModelRequest;
use App\Models\VehicleModel; 
use App\Services\VehicleModelService;
use App\Repositories\VehicleModelRepository;
use App\Repositories\MakeRepository;
use Inertia\Inertia;
use Illuminate\Http\Request;

class VehicleModelController extends Controller
{
    private $vehicleModelService; 
    private $vehicleModelRepository; 
    private $makeRepository; 

    public function __construct(VehicleModelService $vehicleModelService, VehicleModelRepository $vehicleModelRepository, MakeRepository $makeRepository)
    { 
        $this->vehicleModelService = $vehicleModelService;
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
        $vehicleModels = $this->vehicleModelRepository->orderByPaginated($column, $direction); 
    
        return Inertia::render('VehicleModels/Index', [
            'vehicleModels' => $vehicleModels,
        ]); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $makesOptions = $this->makeRepository->getOptions(); 

        return Inertia::render('VehicleModels/Create', [
            'makesOptions' => $makesOptions,
        ]);  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVehicleModelRequest $request)
    {
        $data = $request->validated();
        $vehicleModel = $this->vehicleModelService->createVehicleModel($data); 

        return redirect()->route('modelos.index');
    } 

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VehicleModel $modelo)
    {
        $makesOptions = $this->makeRepository->getOptions(); 

        return Inertia::render('VehicleModels/Edit', [
            'makesOptions' => $makesOptions,
            'vehicleModel' => $modelo,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVehicleModelRequest $request, VehicleModel $modelo)
    {
        $data = $request->validated();
        $vehicleModel = $this->vehicleModelService->updateVehicleModel($modelo->id, $data);

        return redirect()->route('modelos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VehicleModel $modelo)
    {
        $this->vehicleModelRepository->delete($modelo->id);
        return redirect()->route('modelos.index');
    }
}
