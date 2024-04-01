<?php

namespace App\Http\Controllers;

use App\Http\Filters\UsuarioFilter;
use App\Http\Resources\UsuarioCollection;
use App\Http\Resources\UsuarioResource;
use App\Models\Usuario;
use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $filter = new UsuarioFilter();
        $queryItems = $filter->transform($request);
        $includePrestamos = $request->query('includePrestamos');
        $usuarios = Usuario::where($queryItems);

        if ($includePrestamos) {
            $usuarios = $usuarios->with('prestamos');
        }

        return new UsuarioCollection($usuarios->paginate()->appends($request->query()));
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
    public function store(StoreUsuarioRequest $request)
    {
        return new UsuarioResource(Usuario::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        $includePrestamos = request()->query('includePrestamos');
        if ($includePrestamos) {
            return new UsuarioResource($usuario->loadMissing('prestamos'));
        }
        return new UsuarioResource($usuario);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUsuarioRequest $request, Usuario $usuario)
    {
        $usuario->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        //
    }
}
