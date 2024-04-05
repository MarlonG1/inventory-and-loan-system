<?php

namespace App\Http\Controllers;

use App\Http\Filters\LicenciaFilter;
use App\Http\Requests\StoreLicenciaRequest;
use App\Http\Requests\UpdateLicenciaRequest;
use App\Http\Resources\LicenciaCollection;
use App\Http\Resources\LicenciaResource;
use App\Models\Licencia;
use Illuminate\Http\Request;

class LicenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new LicenciaFilter();
        $queryItems = $filter->transform($request);
        $includeEquipos = $request->query('includeEquipos');
        $licencias = Licencia::where($queryItems);

        if ($includeEquipos) {
            $licencias = $licencias->with('equipos');
        }

        return new LicenciaCollection($licencias->paginate()->appends($request->query()));
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
    public function store(StoreLicenciaRequest $request)
    {
        return new LicenciaResource(Licencia::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Licencia $licencia)
    {
        $includeEquipos = request()->query('includeEquipos');
        if ($includeEquipos){
            return new LicenciaResource($licencia->loadMissing('equipos'));
        }
        return new LicenciaResource($licencia);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Licencia $licencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLicenciaRequest $request, Licencia $licencia)
    {
        $licencia->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Licencia $licencia)
    {
        //
    }
}
