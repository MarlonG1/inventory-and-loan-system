<?php

namespace App\Http\Controllers;

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




    //Funciones CRUDS
    public function nuevo_equipo()
    {
        return view('administration.new-computer');
    }
}
