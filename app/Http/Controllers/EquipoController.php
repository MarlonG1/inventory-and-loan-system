<?php

namespace App\Http\Controllers;

use App\Http\Filters\EquipoFilter;
use App\Http\Requests\BulkStoreEquipoRequest;
use App\Http\Resources\Collection;
use App\Http\Resources\EquipoResource;
use App\Models\Equipo;
use App\Http\Requests\StoreEquipoRequest;
use App\Http\Requests\UpdateEquipoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new EquipoFilter();
        $queryItems = $filter->transform($request);
        $includeLicencias = $request->query('includeLicencias');
        $equipos = Equipo::where($queryItems);

        if ($includeLicencias) {
            $equipos = $equipos->with('licencias');
        }

        return new Collection($equipos->paginate()->appends($request->query()));
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
    public function store(StoreEquipoRequest $request)
    {
        return new EquipoResource(Equipo::create($request->all()));
    }

    public function bulkStore(BulkStoreEquipoRequest $request)
    {
        $bulk = collect($request->all())->map(function ($arr,$key) {
           return Arr::except($arr, ['prestamoId']);
        });
        Equipo::insert($bulk->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipo $equipo)
    {
        $includeLicencias = request()->query('includeLicencias');
        if ($includeLicencias) {
            return new EquipoResource($equipo->loadMissing('licencias'));
        }
        return new EquipoResource($equipo);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipo $equipo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEquipoRequest $request, Equipo $equipo)
    {
        $equipo->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipo $equipo)
    {
        //
    }
}
