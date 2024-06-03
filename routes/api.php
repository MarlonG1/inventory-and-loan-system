<?php

use App\Http\Controllers\AulaController;
use App\Http\Controllers\PrestamoHistoricoController;
use App\Http\Controllers\SendEmailController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\LicenciaController;
use App\Http\Controllers\InventarioController;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers', 'middleware' => 'auth:api'], function () {
    Route::apiResource('users', UserController::class);
    Route::apiResource('prestamos', PrestamoController::class);
    Route::apiResource('historicos', PrestamoHistoricoController::class);
    Route::apiResource('licencias', LicenciaController::class);
    Route::apiResource('inventario', InventarioController::class);
    Route::apiResource('aulas', AulaController::class);
    Route::Post('inventario/bulk', ['uses' => 'InventarioController@bulkStore']);
    Route::get('users/destroy-with-prestamos/{user}', [UserController::class, 'destroyWithPrestamos']);
    Route::get('/send/informationEmail/{prestamoId}', [SendEmailController::class, 'send']);
});
