<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormRequest\LoginUsuarioRequest;
use App\Http\Requests\FormRequest\RegistroUsuarioRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class LoginController extends Controller
{
    public function authenticate(LoginUsuarioRequest $request)
    {
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            $token = $this->generateToken($user);
            $request->session()->regenerate();
            return view('inicio', ['token' => $token]);
        }

        return redirect()->back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ]);
    }



    public function logout(Request $request): RedirectResponse
    {
        $cookie = Cookie::forget('auth_cookie');
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->withCookie($cookie);
    }

    public function register(RegistroUsuarioRequest $request): RedirectResponse
    {
        $file = $request->file('image');
        $fileExtension = $file->getClientOriginalExtension();
        $fileName = $request->input('email') . '.' . $fileExtension;
        $file->move(public_path() . '/img/profile-photos/', $fileName);

        User::create([
            'departamento_id' => $request->input('departamentoId'),
            'carrera_id' => $request->input('carreraId'),
            'name' => $request->input('name'),
            'lastname' => $request->input('lastname'),
            'phone' => $request->input('phone'),
            'birth_date' => $request->input('birthDate'),
            'type' => 'Estudiante',
            'carnet' => $request->input('carnet'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'image' => '/img/profile-photos/' . $fileName,
        ]);

        return redirect('/login');
    }

    public function generateToken($user)
    {
        if($user->type === 'Administrador'){
            return $user->createToken('auth_cookie', ['create', 'update', 'delete'], now()->addDays(2))->plainTextToken;
        }

        return $user->createToken('auth_cookie', ['create'], now()->addDay())->plainTextToken;
    }

}
