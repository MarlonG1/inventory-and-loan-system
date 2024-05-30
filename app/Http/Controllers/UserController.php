<?php

namespace App\Http\Controllers;

use App\Http\Filters\UserFilter;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\Collection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isEmpty;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new UserFilter();
        $queryItems = $filter->transform($request);
        $searchTerm = $request->query('searchTerm');
        $include = $request->query('include', '');
        $includeAll = $request->query('includeAll');
        $entriesPerPage = $request->query('entriesPerPage');
        $user = User::where($queryItems);

        if ($includeAll) {
            $prestamos = $user->orderBy('fecha_prestamo', 'desc');
            return new Collection($prestamos->get());
        } else if ($searchTerm) {
            //Los parametros de filtros se configuran directamente en los modelos
            $user = User::searchQuery($searchTerm);
            return new Collection($user);

        } else {

            if ($include !== '') {
                $include = explode(',', $request->query('include', ''));
                foreach ($include as $relation) {
                    $user = $user->with($relation);
                }
            }

            $user = $user->orderBy('id', 'desc')->paginate($entriesPerPage)->appends($request->query());
            return new Collection($user);
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
    public function store(StoreUserRequest $request)
    {
        return new UserResource(User::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $include = request()->query('include', '');
        if ($include !== '') {
            $include = explode(',', request()->query('include', ''));
            foreach ($include as $relation) {
                $user = $user->loadMissing($relation);
            }
            return new UserResource($user);
        }
        return new UserResource($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $user->update($request->all());
            return response()->json(['icon' => 'success', 'title' => 'Actualización exitosa', 'text' => 'Usuario actualizado correctamente'], 200);
        } catch (\Throwable $e) {
            return response()->json(['icon' => 'error', 'title' => 'Actualización fallida', 'text' => 'Ocurrió un error al intentar actualizar el usuario'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return response()->json(['icon' => 'success', 'title' => 'Eliminación exitosa', 'text' => 'Usuario eliminado correctamente'], 200);
        } catch (\Throwable $e) {
            $errorMessage = 'Ocurrió un error al intentar eliminar el usuario';

            if ($e instanceof ModelNotFoundException) {
                $errorMessage = 'No se encontró el usuario especificado';
                $statusCode = 400;
            } else {
                $statusCode = 500;
            }

            return response()->json(['icon' => 'error', 'title' => 'Eliminación fallida', 'text' => $errorMessage], $statusCode);
        }
    }
}
