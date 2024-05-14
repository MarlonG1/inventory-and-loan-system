<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use App\Models\Aula;
use App\Models\Carrera;
use App\Models\Departamento;
use App\Models\Equipo;
use App\Models\Prestamo;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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
        $departamentos = Departamento::all();
        return view('auth.register', compact('departamentos'));
    }

    public function perfil()
    {
        return view('profile');
    }

    public function dashboard()
    {
        $usuariosPorDepartamentos = DB::Table('users')
            ->select('departamentos.nombre as departamento', DB::raw('count(users.id) as cantidad'))
            ->join('departamentos', 'users.departamento_id', '=', 'departamentos.id')
            ->groupBy('departamentos.nombre')
            ->get();

        return view('administration.dashboard', compact('usuariosPorDepartamentos'));
    }

    public function faqs()
    {
        return view('faqs');
    }

    public function pointOfSale()
    {
        $cantidadPorMarca = DB::Table('equipos')
            ->select('equipos.marca as nombre', DB::raw('count(equipos.id) as cantidad'))
            ->where('equipos.estado', '=', 'Disponible')
            ->groupBy('equipos.marca')
            ->get();

        $usuarios = User::all();
        $equipos = Equipo::all()->where('estado', '=', 'Disponible');
        $aulas = Aula::all();
        $carreras = Carrera::all();
        $asignaturas = Asignatura::all();

        return view('administration.pos', compact('usuarios', 'equipos', 'aulas', 'carreras', 'asignaturas', 'cantidadPorMarca'));
    }

    public function solicitud_equipo()
    {
        $usuarios = User::all();
        $equipos = Equipo::all()->where('estado', '=', 'Disponible');
        $aulas = Aula::all();
        $carreras = Carrera::all();
        $asignaturas = Asignatura::all();

        return view('computer-request', compact('usuarios', 'equipos', 'aulas', 'carreras', 'asignaturas'));
    }

    public function viewPdf($prestamoId)
    {
        $prestamo = Prestamo::with('equipos', 'aula')->findOrFail($prestamoId);

        $pdf = PDF::loadView('reports.pdf-prestamos', ['prestamo' => $prestamo], [], [
            'title' => 'registroNum' . $prestamo->id,
            'margin_left' => 0,
            'margin_right' => 0,
            'margin_top' => 40,
            'margin_bottom' => 25,
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
        $usuarios = User::all();
        $equiposOcupados = Equipo::all();
        $equiposDisponibles = Equipo::all()->where('estado', '=', 'Disponible');
        $aulas = Aula::all();
        $carreras = Carrera::all();
        $asignaturas = Asignatura::all();

        return view('administration.prestamos-records', compact('usuarios', 'equiposOcupados', 'aulas', 'equiposDisponibles', 'carreras', 'asignaturas'));
    }
}
