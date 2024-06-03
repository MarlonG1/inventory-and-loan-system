<?php

namespace App\Http\Controllers;

use App\Http\Filters\InventarioFilter;
use App\Http\Requests\BulkStoreEquipoRequest;
use App\Http\Resources\Collection;
use App\Http\Resources\InventarioResource;
use App\Models\Inventario;
use App\Http\Requests\StoreInventarioRequest;
use App\Http\Requests\UpdateInventarioRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public array $directory = [
        'Accesorio' => 'accesorios/',
        'Dispositivo' => 'dispositivos/',
        'Equipo' => 'equipos/',
    ];

    public function index(Request $request)
    {
        $filter = new InventarioFilter();
        $queryItems = $filter->transform($request);
        $searchTerm = $request->query('searchTerm');
        $include = $request->query('include', '');
        $includeAll = $request->query('includeAll');
        $entriesPerPage = $request->query('entriesPerPage');
        $inventario = Inventario::where($queryItems);

        $inventariosTotales = [
            'totalDeDisponibles' => Inventario::where('estado', 'Disponible')->count(),
            'totalDeOcupados' => Inventario::where('estado', 'Ocupado')->count(),
            'totalDeEnReparacion' => Inventario::where('estado', 'En reparación')->count(),
        ];

        if ($includeAll) {
            $inventario = $inventario->orderBy('id', 'desc');
            return new Collection($inventario->get(), $inventariosTotales);
        } else if ($searchTerm) {
            //Los parametros de filtros se configuran directamente en los modelos
            $equipo = Inventario::searchQuery($searchTerm);
            return new Collection($inventario, $inventariosTotales);
        } else {

            if ($include !== '') {
                $include = explode(',', $request->query('include', ''));
                foreach ($include as $relation) {
                    $inventario = $inventario->with($relation);
                }
            }

            $inventario = $inventario->orderBy('id', 'desc')->paginate($entriesPerPage)->appends($request->query());
            return new Collection($inventario, $inventariosTotales);
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
    public function store(StoreInventarioRequest $request)
    {
        return new InventarioResource(Inventario::create($request->all()));
    }

    public function bulkStore(BulkStoreEquipoRequest $request)
    {
        $bulk = collect($request->all())->map(function ($arr, $key) {
            return Arr::except($arr, ['prestamoId']);
        });
        Inventario::insert($bulk->toArray());
    }

    public function changePhoto(Request $request, $id)
    {

        $request->validate([
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $inventario = Inventario::findOrFail($id);
        try {
            if ($request->hasFile('imagen')) {

                if ($inventario->image) {
                    $oldImagePath = public_path($inventario->image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                $file = $request->file('imagen');
                $fileExtension = $file->getClientOriginalExtension();
                $fileName = $inventario->marca . '(' . $inventario->identificador . ').' . $fileExtension;
                $file->move(public_path() . "/img/inventario/" . $this->directory[$inventario->tipo], $fileName);

                $inventario->update([
                    'imagen' => '/img/inventario/' . $this->directory[$inventario->tipo] . $fileName,
                ]);

            }
            return redirect()->back()->with('success', 'Imagen actualizada correctamente');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar actualizar la imagen');
        }
    }

    public function registerNewData(Request $request)
    {
        $file = $request->file('imagen');
        $fileExtension = $file->getClientOriginalExtension();
        $fileName = $request->input('marca') . '(' . $request->input('identificador') . ').' . $fileExtension;
        $file->move(public_path() . "/img/inventario/" . $this->directory[$request->input('tipo')], $fileName);

        try {
            Inventario::create([
                'marca' => $request->input('marca'),
                'modelo' => $request->input('modelo'),
                'identificador' => $request->input('identificador'),
                'tipo' => $request->input('tipo'),
                'estado' => $request->input('estado'),
                'observaciones' => $request->input('observaciones'),
                'imagen' => '/img/inventario/' . $this->directory[$request->input('tipo')] . $fileName,
            ]);

            return redirect()->back()->with('success', 'Elemento registrado correctamente');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar registrar el elemento');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventario $inventario)
    {
        $include = request()->query('include', '');
        if ($include !== '') {
            $include = explode(',', request()->query('include', ''));
            foreach ($include as $relation) {
                $inventario = $inventario->loadMissing($relation);
            }
        }
        return new InventarioResource($inventario);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventario $inventario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInventarioRequest $request, Inventario $inventario)
    {
        try {
            $inventario->update($request->all());
            return response()->json(['icon' => 'success', 'title' => 'Actualización exitosa', 'text' => 'Elemento actualizado con exito']);
        } catch (\Exception $e) {
            return response()->json(['icon' => 'error', 'title' => 'Actualización fallida', 'text' => 'No se pudo actualizar el equipo']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventario $inventario)
    {
        try {
            $inventario->delete();
            return response()->json(['icon' => 'success', 'title' => 'Eliminación exitosa', 'text' => 'Eliminación con exito']);
        } catch (\Exception $e) {
            return response()->json(['icon' => 'error', 'title' => 'Eliminación fallida', 'text' => 'No se pudo eliminar el equipo']);
        }
    }
}
