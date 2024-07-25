<?php

namespace App\Http\Controllers;

use App\Http\Resources\Collection;
use App\Http\Resources\PrestamoResource;
use App\Http\Traits\SearchTrait;
use App\Models\Prestamo;
use App\Http\Requests\StorePrestamoRequest;
use App\Http\Requests\UpdatePrestamoRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Filters\PrestamoFilter;
use Illuminate\Support\Facades\DB;
use Mpdf\Tag\Pre;
use Psy\Util\Json;
use function PHPUnit\Framework\isEmpty;

class PrestamoController extends Controller
{

    public function __construct()
    {
        // Aplicar throttling solo al método index
        $this->middleware('throttle:500,1')->only('index');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new PrestamoFilter();
        $queryItems = $filter->transform($request);
        $searchTerm = $request->query('searchTerm');
        $include = $request->query('include', '');
        $includeAll = $request->query('includeAll');
        $entriesPerPage = $request->query('entriesPerPage');
        $prestamos = Prestamo::where($queryItems);

        $prestamosTotales = [
            'totalDeActivos' => Prestamo::where('estado', 'Activo')->count(),
            'totalDeFinalizados' => Prestamo::where('estado', 'Finalizado')->count(),
            'totalDePendientes' => Prestamo::where('estado', 'Pendiente')->count(),
        ];

        if ($includeAll) {
            $prestamos = $prestamos->orderBy('fecha_prestamo', 'desc');
            return new Collection($prestamos->get(), $prestamosTotales);
        } else if ($searchTerm) {
            //Los parametros de filtros se configuran directamente en los modelos
            $prestamos = Prestamo::searchQuery($searchTerm);
            return new Collection($prestamos, $prestamosTotales);

        } else {

            if ($include !== '') {
                $include = explode(',', $request->query('include', ''));
                foreach ($include as $relation) {
                    $prestamos = $prestamos->with($relation);
                }
            }

            $prestamos = $prestamos->orderBy('id', 'desc')->paginate($entriesPerPage)->appends($request->query());
            return new Collection($prestamos, $prestamosTotales);
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
    public function store(StorePrestamoRequest $request)
    {
        return new PrestamoResource(Prestamo::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Prestamo $prestamo)
    {
        $include = request()->query('include');

        if ($include !== '') {
            $include = explode(',', request()->query('include', ''));
            foreach ($include as $relation) {
                $prestamo = $prestamo->loadMissing($relation);
            }
            return new PrestamoResource($prestamo);
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
        try {
            $prestamo->update($request->all());
            return response()->json(['icon' => 'success', 'title' => 'Actualización exitosa', 'text' => 'Prestamo actualizado correctamente', 'id' => $prestamo->id], 200);
        } catch (\Throwable $e) {
            return response()->json(['icon' => 'error', 'title' => 'Actualización fallida', 'text' => 'Ocurrió un error al intentar actualizar el préstamo'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prestamo $prestamo)
    {
        try {
            $prestamo = $prestamo->loadMissing('inventario');

            foreach ($prestamo->inventario as $equipo) {
                $equipo->estado = "Disponible";
                $equipo->save();
            }

            $prestamo->delete();

            return response()->json(['icon' => 'success', 'title' => 'Eliminacion exitosa', 'text' => 'Préstamo eliminado correctamente'], 200);
        } catch (\Exception $e) {
            $errorMessage = 'Ocurrió un error al intentar eliminar el préstamo';

            if ($e instanceof ModelNotFoundException) {
                $errorMessage = 'No se encontró el préstamo especificado';
                $statusCode = 400;
            } else {
                $statusCode = 500;
            }

            return response()->json(['icon' => 'error', 'title' => 'Eliminación fallida', 'text' => $errorMessage], $statusCode);
        }
    }
}

