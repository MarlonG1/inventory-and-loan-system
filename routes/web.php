<?php

use App\Http\Controllers\SendEmailController;
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
        'image' => $user_google->avatar,
    ]);

    Auth::login($user);
    return redirect('/');
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
    Route::get('/send/informationEmail/{prestamoId}', [SendEmailController::class, 'send'])->name('sendInformationEmail');

    //Administracion
    Route::get('/nuevo-equipo', [VistaController::class, 'nuevo_equipo'])->name('nuevo-equipo');
    Route::get('/pos', [VistaController::class, 'pointOfSale'])->name('pos');
    Route::get('/dashboard', [VistaController::class, 'dashboard'])->name('dashboard');
    Route::get('/registros-prestamos', [VistaController::class, 'registro_prestamos'])->name('registros-prestamos');
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

