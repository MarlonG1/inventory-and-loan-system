<?php

use App\Http\Requests\BulkStoreEquipoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\LicenciaController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\EquipoLicenciaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Autenticación 'middleware' => 'auth:sanctum'
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers'], function () {

    Route::apiResource('usuarios', UsuarioController::class);
    Route::apiResource('prestamos', PrestamoController::class);
    Route::apiResource('licencias', LicenciaController::class);
    Route::apiResource('equipos', EquipoController::class);
    Route::Post('equipos/bulk', ['uses' => 'EquipoController@bulkStore']);

});
