<?php

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
Route::get('/login', [VistaController::class, 'login'])->name('login');
Route::get('/registro', [VistaController::class, 'registro'])->name('registro');



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

