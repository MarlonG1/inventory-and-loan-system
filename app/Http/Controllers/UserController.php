<?php

namespace App\Http\Controllers;

use App\Http\Filters\UserFilter;
use App\Http\Requests\FormRequest\RegistroUsuarioRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\Collection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
            $user = $user->orderBy('id', 'desc');
            return new Collection($user->get());
        } else if ($searchTerm) {
            //Los parametros de filtros se configuran directamente en los modelos
            $user = User::searchQuery($searchTerm);
            return new Collection($user, $user->count());

        } else {

            if ($include !== '') {
                $include = explode(',', $request->query('include', ''));
                foreach ($include as $relation) {
                    $user = $user->with($relation);
                }
            }

            $user = $user->orderBy('id', 'desc')->paginate($entriesPerPage)->appends($request->query());
            return new Collection($user, $user->count());
        }
    }

    public function changePhoto(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = User::findOrFail($id);
        try {

            if ($request->hasFile('image')) {

                if ($user->image) {
                    $oldImagePath = public_path($user->image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                $file = $request->file('image');
                $fileExtension = $file->getClientOriginalExtension();
                $fileName = $user->email . '.' . $fileExtension;
                $file->move(public_path() . '/img/profile-photos/', $fileName);

                $user->update([
                    'image' => '/img/profile-photos/' . $fileName,
                ]);
            }
            return redirect()->back()->with('success', 'Imagen actualizada correctamente');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar actualizar la imagen del usuario');
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
            return response()->json(['icon' => 'error', 'title' => 'Actualización fallida', 'text' => 'Ocurrió un error al intentar actualizar el usuario' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */

    public function registerNewUser(RegistroUsuarioRequest $request)
    {
        $file = $request->file('image');
        $fileExtension = $file->getClientOriginalExtension();
        $fileName = $request->input('email') . '.' . $fileExtension;
        $file->move(public_path() . '/img/profile-photos/', $fileName);

        try {
            User::create([
                'departamento_id' => $request->input('departamentoId'),
                'carrera_id' => $request->input('carreraId'),
                'name' => $request->input('name'),
                'lastname' => $request->input('lastname'),
                'phone' => $request->input('phone'),
                'birth_date' => $request->input('birthDate'),
                'type' => $request->input('type'),
                'carnet' => $request->input('carnet'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'image' => '/img/profile-photos/' . $fileName,
            ]);

            return redirect()->back()->with('success', 'Usuario registrado correctamente');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar registrar el usuario');
        }
    }

    public function destroyWithPrestamos(User $user)
    {
        try {
            $user = $user->loadMissing('prestamos');
            $prestamoController = new PrestamoController();

            foreach ($user->prestamos as $prestamo) {
                $prestamoController->destroy($prestamo);
            }

            $user->delete();
            return response()->json(['icon' => 'success', 'title' => 'Eliminación exitosa', 'text' => 'Usuario y sus prestamos eliminado correctamente'], 200);
        } catch (\Throwable $e) {
            return response()->json(['icon' => 'error', 'title' => 'Eliminación fallida', 'text' => 'Ocurrió un error al intentar eliminar los prestamos del usuario'], 500);
        }
    }

    public function destroy(User $user)
    {
        try {
            $user = $user->loadMissing('prestamos');
            if ($user->prestamos->count() > 0) {
                return response()->json(['icon' => 'error', 'title' => 'Eliminación fallida', 'text' => 'El usuario tiene préstamos asociados', "asociados" => true], 200);
            }

            $user->delete();
            return response()->json(['icon' => 'success', 'title' => 'Eliminación exitosa', 'text' => 'Usuario eliminado correctamente'], 200);
        } catch (\Throwable $e) {
            $errorCode = $e->errorInfo[1];
            $errorMessage = '';

            switch ($errorCode) {
                case 400:
                    $errorMessage = 'No se encontró el usuario especificado';
                    $statusCode = 400;
                    break;
                default:
                    $errorMessage = 'Ocurrió un error al intentar eliminar el usuario';
                    $statusCode = 500;
                    break;
            }
            return response()->json(['icon' => 'error', 'title' => 'Eliminación fallida', 'text' => $errorMessage], $statusCode);
        }
    }
}
