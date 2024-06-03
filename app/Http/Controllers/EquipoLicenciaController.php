<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EquipoLicenciaController extends Controller
{
//    public function index(Request $request)
//    {
//        $filter = new InventarioFilter();
//        $queryItems = $filter->transform($request);
//        $searchTerm = $request->query('searchTerm');
//        $include = $request->query('include', '');
//        $includeAll = $request->query('includeAll');
//        $entriesPerPage = $request->query('entriesPerPage');
//        $equipo = Inventario::where($queryItems);
//
//        if ($includeAll) {
//            $equipo = $equipo->orderBy('id', 'desc');
//            return new Collection($equipo->get());
//        } else if ($searchTerm) {
//            //Los parametros de filtros se configuran directamente en los modelos
//            $equipo = Inventario::searchQuery($searchTerm);
//            return new Collection($equipo, $equipo->count());
//
//        } else {
//
//            if ($include !== '') {
//                $include = explode(',', $request->query('include', ''));
//                foreach ($include as $relation) {
//                    $equipo = $equipo->with($relation);
//                }
//            }
//
//            $equipo = $equipo->orderBy('id', 'desc')->paginate($entriesPerPage)->appends($request->query());
//            return new Collection($equipo);
//        }
//    }
//
//    /**
//     * Show the form for creating a new resource.
//     */
//    public function create()
//    {
//        //
//    }
//
//    /**
//     * Store a newly created resource in storage.
//     */
//    public function store(StoreInventarioRequest $request)
//    {
//        return new InventarioResource(Inventario::create($request->all()));
//    }
//
//    public function bulkStore(BulkStoreEquipoRequest $request)
//    {
//        $bulk = collect($request->all())->map(function ($arr, $key) {
//            return Arr::except($arr, ['prestamoId']);
//        });
//        Inventario::insert($bulk->toArray());
//    }
//
//    /**
//     * Display the specified resource.
//     */
//    public function show(Inventario $equipo)
//    {
//        $includeLicencias = request()->query('includeLicencias');
//        if ($includeLicencias) {
//            return new InventarioResource($equipo->loadMissing('licencias'));
//        }
//        return new InventarioResource($equipo);
//    }
//
//    /**
//     * Show the form for editing the specified resource.
//     */
//    public function edit(Inventario $equipo)
//    {
//        //
//    }
//
//    /**
//     * Update the specified resource in storage.
//     */
//    public function update(UpdateInventarioRequest $request, Inventario $equipo)
//    {
//        try {
//            $equipo->update($request->all());
//            return response()->json(['icon' => 'success', 'title' => 'Actualización exitosa', 'text' => 'Inventario actualizado con exito']);
//        } catch (\Exception $e) {
//            return response()->json(['icon' => 'error', 'title' => 'Actualización fallida', 'text' => 'No se pudo actualizar el equipo']);
//        }
//    }
}
