<?php

use App\Http\Controllers\InventarioController;
use App\Http\Controllers\SendEmailController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
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

Route::get('/google-redirect/redirect', function () {
    return Socialite::driver('google')->redirect();
});
Route::get('/google-redirect/callback', function () {
    $user_google = Socialite::driver('google')->stateless()->user();

    $user = User::firstOrCreate([
        'google_id' => $user_google->id,
    ], [
        'name' => $user_google->user['given_name'],
        'lastname' => $user_google->user['family_name'],
        'email' => $user_google->email,
        'type' => 'Estudiante',
        'carnet' => '0000-AA-000',
        'phone' => '0000-0000',
        'birth_date' => '2000-01-01',
        'carrera_id' => 13,
        'departamento_id' => 1,
        'image' => $user_google->avatar,
    ]);

    $loginController = new LoginController();
    $token = $loginController->generateToken($user);

    Auth::login($user);
    return view('inicio', ['token' => $token]);
});

Route::group([],function () {
    Route::get('/', [VistaController::class, 'index']);
    Route::get('/faqs', [VistaController::class, 'faqs'])->name('faqs');
    Route::get('/registro', [VistaController::class, 'registro'])->name('registro');
    Route::get('/login', [VistaController::class, 'login'])->name('authenticate');
    Route::post('/registro', [LoginController::class, 'register']);
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
});

Route::middleware('auth:sanctum')->group(function () {
    //Usuario
    Route::get('/perfil', [VistaController::class, 'perfil'])->name('perfil');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    //Solicitud
    Route::get('/solicitud-equipo', [VistaController::class, 'solicitud_equipo'])->name('solicitud-equipo');

    //Reportes
    Route::get('/pdf/{prestamoId}', [VistaController::class, 'viewPdf'])->name('pdf');
    Route::get('/ticket/{prestamoId}', [VistaController::class, 'viewTicket'])->name('ticket');
});

Route::group(['prefix' => 'administracion', 'namespace' => 'App\Http\Controllers', 'middleware' => 'auth:web'], function () {
    Route::get('/nuevo-equipo', [VistaController::class, 'nuevo_equipo'])->name('nuevo-equipo');
    Route::get('/pos', [VistaController::class, 'pointOfSale'])->name('pos');
    Route::get('/dashboard', [VistaController::class, 'dashboard'])->name('dashboard');

    Route::post('users/change-photo/{id}', [UserController::class, 'changePhoto'])->name('change-photo');
    Route::post('/users/register-new-user', [UserController::class, 'registerNewUser'])->name('register-new-user');
    Route::post('inventario/change-inventory-photo/{id}', [InventarioController::class, 'changePhoto'])->name('change-inventory-photo');
    Route::post('/inventario/register-new-inventory', [InventarioController::class, 'registerNewData'])->name('register-new-inventory');

    Route::get('/registros-prestamos', [VistaController::class, 'registro_prestamos'])->name('registros-prestamos');
    Route::get('/registros-usuarios', [VistaController::class, 'registro_usuarios'])->name('registros-usuarios');
    Route::get('/registros-equipos', [VistaController::class, 'registro_equipos'])->name('registros-equipos');
    Route::get('/registros-licencias', [VistaController::class, 'registro_licencias'])->name('registros-licencias');
    Route::get('/registros-accesorios', [VistaController::class, 'registro_accesorios'])->name('registros-accesorios');
    Route::get('/registros-dispositivos', [VistaController::class, 'registro_dispositivo'])->name('registros-dispositivos');
});

Route::get('/setup', function () {
    $credentials = [
        'email' => 'admin@admin.com',
        'password' => 'password'
    ];

    if (!Auth::attempt($credentials)) {
        $user = new \App\Models\User();
        $user->name = 'Admin';
        $user->lastname = 'Admin';
        $user->type = 'Administrador';
        $user->image= '';
        $user->email = $credentials['email'];
        $user->password = Hash::make($credentials['password']);
        $user->save();
    }

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        $adminToken = $user->createToken('admin-token', ['create', 'update', 'delete']);

        return [
            'admin' => $adminToken->plainTextToken,
        ];
    }
});

//Manejo de imagenes para evitar el asset() de Laravel
Route::get('img/{filename}', function ($filename) {
    return response()->file(public_path('img/' . $filename));
})->where('filename', '.*');

