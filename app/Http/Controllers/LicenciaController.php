<?php

namespace App\Http\Controllers;

use App\Http\Filters\LicenciaFilter;
use App\Http\Requests\StoreLicenciaRequest;
use App\Http\Requests\UpdateLicenciaRequest;
use App\Http\Resources\Collection;
use App\Http\Resources\LicenciaResource;
use App\Models\Licencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LicenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new LicenciaFilter();
        $queryItems = $filter->transform($request);
        $searchTerm = $request->query('searchTerm');
        $include = $request->query('include', '');
        $includeAll = $request->query('includeAll');
        $entriesPerPage = $request->query('entriesPerPage');
        $licencia = Licencia::where($queryItems);

        $licenciasTotales = [
            'totalDeActivas' => Licencia::where('estado', 'Activa')->count(),
            'totalPorRenovar' => Licencia::where('estado', 'Por renovar')->count(),
            'totalDeInactivas' => Licencia::where('estado', 'Inactiva')->count(),
            'totalVencidas' => Licencia::where('estado', 'Vencida')->count(),
        ];

        if ($includeAll) {
            $licencia = $licencia->orderBy('id', 'desc');
            return new Collection($licencia->get(), $licenciasTotales);
        } else if ($searchTerm) {
            //Los parametros de filtros se configuran directamente en los modelos
            $licencia = Licencia::searchQuery($searchTerm);
            return new Collection($licencia, $licenciasTotales);
        } else {

            if ($include !== '') {
                $include = explode(',', $request->query('include', ''));
                foreach ($include as $relation) {
                    $licencia = $licencia->with($relation);
                }
            }

            $licencia = $licencia->orderBy('id', 'desc')->paginate($entriesPerPage)->appends($request->query());
            return new Collection($licencia, $licenciasTotales);
        }
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
        try {
            $licencia = Licencia::create($request->all());
            $licencia->update([
                'clave' => Hash::make($request->clave),
            ]);
            return response()->json(['icon' => 'success', 'title' => 'Creación exitosa', 'text' => 'Licencia creada correctamente'], 200);
        } catch (\Throwable $e) {
            return response()->json(['icon' => 'error', 'title' => 'Creación fallida', 'text' => 'Ocurrió un error al intentar crear la licencia' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Licencia $licencia)
    {
        $include = request()->query('include', '');
        if ($include !== '') {
            $include = explode(',', request()->query('include', ''));
            foreach ($include as $relation) {
                $licencia = $licencia->loadMissing($relation);
            }
        }
        return new LicenciaFilter($licencia);
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
        try {
            $licencia->update($request->all());

            return response()->json(['icon' => 'success', 'title' => 'Actualización exitosa', 'text' => 'Licencia actualizada correctamente'], 200);
        } catch (\Throwable $e) {
            return response()->json(['icon' => 'error', 'title' => 'Actualización fallida', 'text' => 'Ocurrió un error al intentar actualizar la licencia' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Licencia $licencia)
    {
        try {
            $licencia->delete();
            return response()->json(['icon' => 'success', 'title' => 'Eliminación exitosa', 'text' => 'Licencia eliminada correctamente'], 200);
        } catch (\Throwable $e) {
            return response()->json(['icon' => 'error', 'title' => 'Eliminación fallida', 'text' => 'Ocurrió un error al intentar eliminar la licencia'], 500);
        }
    }
}
