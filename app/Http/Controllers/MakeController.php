<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMakeRequest;
use App\Http\Requests\UpdateMakeRequest;
use App\Models\Make;
use App\Repositories\MakeRepository;
use App\Services\MakeService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MakeController extends Controller
{
    private $makeService;

    private $makeRepository;

    public function __construct(MakeService $makeService, MakeRepository $makeRepository)
    {
        $this->makeService = $makeService;
        $this->makeRepository = $makeRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $column = $request->get('column', 'id');
        $direction = $request->get('direction', 'asc');
        $makes = $this->makeRepository->orderByPaginated($column, $direction);

        return Inertia::render('Makes/Index', [
            'makes' => $makes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Makes/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMakeRequest $request)
    {
        $data = $request->validated();
        $make = $this->makeService->createMake($data);

        return redirect()->route('marcas.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Make $marca)
    {
        return Inertia::render('Makes/Edit', [
            'make' => $marca,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMakeRequest $request, Make $marca)
    {
        $data = $request->validated();
        $make = $this->makeService->updateMake($marca->id, $data);

        return redirect()->route('marcas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Make $marca)
    {
        $this->makeRepository->delete($marca->id);

        return redirect()->route('marcas.index');
    }
}
