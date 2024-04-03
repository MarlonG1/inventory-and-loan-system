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
        return view('login');
    }

    public function registro()
    {
        return view('register');
    }
}
