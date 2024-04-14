<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use App\Models\Equipo;
use App\Models\Prestamo;
use App\Models\User;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf as PDF;

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

    public function dashboard()
    {
        return view('administration.dashboard');
    }

    public function solicitud_equipo()
    {
        $usuarios = User::all()->where('type', 'Administrador');
        $equipos = Equipo::all()->where('estado', '=', 'Disponible');
        $aulas = Aula::all();

        return view('computer-request', ['usuarios' => $usuarios, 'equipos' => $equipos, 'aulas' => $aulas]);
    }

    public function viewPdf($prestamoId)
    {
        $prestamo = Prestamo::with('equipos', 'aula')->findOrFail($prestamoId);

        $pdf = PDF::loadView('reports.pdf-prestamos', ['prestamo' => $prestamo], [], [
            'title' => 'registroNum' . $prestamo->id,
        ]);

        return $pdf->stream('registroNum' . $prestamo->id . '.pdf');
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
