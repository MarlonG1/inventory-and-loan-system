<?php

namespace App\Http\Controllers;

use App\Http\Resources\PrestamoCollection;
use App\Http\Resources\PrestamoResource;
use App\Models\Prestamo;
use App\Http\Requests\StorePrestamoRequest;
use App\Http\Requests\UpdatePrestamoRequest;
use Illuminate\Http\Request;
use App\Http\Filters\PrestamoFilter;

class PrestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new PrestamoFilter();
        $queryItems = $filter->transform($request);
        $includeEquipos = $request->query('includeEquipos');
        $prestamos = Prestamo::where($queryItems);

        if ($includeEquipos) {
            $prestamos = $prestamos->with('equipos');
        }

        return new PrestamoCollection($prestamos->paginate()->appends($request->query()));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePrestamoRequest $request)
    {
        return new PrestamoResource(Prestamo::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Prestamo $prestamo)
    {
        $includeEquipos = request()->query('includeEquipos');
        if ($includeEquipos) {
            return new PrestamoResource($prestamo->loadMissing('equipos'));
        }
        return new PrestamoResource($prestamo);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prestamo $prestamo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePrestamoRequest $request, Prestamo $prestamo)
    {
        $prestamo->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prestamo $prestamo)
    {
        //
    }
}
