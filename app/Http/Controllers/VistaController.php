<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Prestamo;
use App\Models\User;
use Illuminate\Http\Request;

class VistaController extends Controller
{
    public function index()
    {
        return view('inicio');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function registro()
    {
        return view('auth.register');
    }

    public function perfil()
    {
        return view('profile');
    }

    public function solicitud_equipo()
    {
        $usuarios = User::all()->where('type', 'Administrador');
        $equipos = Equipo::all()->where('estado', '=', 'Disponible');

        return view('computer-request', ['usuarios' => $usuarios, 'equipos' => $equipos]);
    }


    //Funciones CRUDS
    public function nuevo_equipo()
    {
        return view('administration.new-computer');
    }

    //Registros

    public function registro_prestamos()
    {
        return view('administration.prestamos-records');
    }
}
