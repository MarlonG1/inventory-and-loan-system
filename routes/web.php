<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\VistaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [VistaController::class, 'index']);
Route::get('/perfil', [VistaController::class, 'perfil'])->name('perfil');
Route::get('/nuevo-equipo', [VistaController::class, 'nuevo_equipo'])->name('nuevo-equipo');
Route::get('/solicitud-equipo', [VistaController::class, 'solicitud_equipo'])->name('solicitud-equipo');

//Usuario
Route::get('/registro', [VistaController::class, 'registro'])->name('registro');
Route::post('/registro', [LoginController::class, 'register']);

Route::get('/login', [VistaController::class, 'login'])->name('authenticate');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//Registros

Route::get('/registros-prestamos', [VistaController::class, 'registro_prestamos'])->name('registros-prestamos');



//Route::get('/', function () {
//    return view('/', 'VistaController@index');
////    return view('master');
//});

Route::get('/setup', function () {
    $credentials = [
        'email' => 'admin@admin.com',
        'password' => 'password'
    ];

    if (!Auth::attempt($credentials)) {
        $user = new \App\Models\User();
        $user->name = 'Admin';
        $user->email = $credentials['email'];
        $user->password = Hash::make($credentials['password']);
        $user->save();
    }

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        $adminToken = $user->createToken('admin-token', ['create', 'update', 'delete']);
        $updateToken = $user->createToken('update-token', ['create', 'update']);
        $basicToken = $user->createToken('basic-token');

        return [
            'admin' => $adminToken->plainTextToken,
            'update' => $updateToken->plainTextToken,
            'basic' => $basicToken->plainTextToken
        ];
    }
});

//Manejo de imagenes para evitar el asset() de Laravel
Route::get('img/{filename}', function ($filename) {
    return response()->file(public_path('img/' . $filename));
})->where('filename', '.*');

