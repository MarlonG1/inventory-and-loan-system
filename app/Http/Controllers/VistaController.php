<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use App\Models\Aula;
use App\Models\Carrera;
use App\Models\Departamento;
use App\Models\Inventario;
use App\Models\Licencia;
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
        $carreras = Carrera::all();

        return view('auth.register', compact('departamentos', 'carreras'));
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
        $cantidadPorMarca = DB::Table('inventario')
            ->select('inventario.marca as nombre', DB::raw('count(inventario.id) as cantidad'))
            ->where('inventario.estado', '=', 'Disponible')
            ->groupBy('inventario.marca')
            ->get();

        $usuarios = User::all();
        $inventario = Inventario::all()->where('estado', '=', 'Disponible');
        $aulas = Aula::all();
        $carreras = Carrera::all();
        $asignaturas = Asignatura::all();

        return view('administration.pos', compact('usuarios', 'inventario', 'aulas', 'carreras', 'asignaturas', 'cantidadPorMarca'));
    }

    public function solicitud_equipo()
    {
        $usuarios = User::all();
        $inventarios = Inventario::all()->where('tipo', '=', 'Equipo')->where('estado', '=', 'Disponible');
        $aulas = Aula::all();
        $carreras = Carrera::all();
        $asignaturas = Asignatura::all();

        return view('computer-request', compact('usuarios', 'inventarios', 'aulas', 'carreras', 'asignaturas'));
    }

    public function viewPdf($prestamoId)
    {
        $prestamo = Prestamo::with('inventario', 'aula', 'user')->findOrFail($prestamoId);

        $pdf = PDF::loadView('reports.pdf-prestamos', ['prestamo' => $prestamo], [], [
            'title' => 'registroNum' . $prestamo->id,
            'margin_left' => 0,
            'margin_right' => 0,
            'margin_top' => 40,
            'margin_bottom' => 25,
        ]);

        return $pdf->stream('registroNum' . $prestamo->id . '.pdf');
    }

    public function viewTicket($prestamoId)
    {
        $prestamo = Prestamo::with('inventario', 'aula', 'user')->findOrFail($prestamoId);

        $pdf = PDF::loadView('reports.ticket-prestamos', ['prestamo' => $prestamo], [], [
            'title' => 'ticketNum' . $prestamo->id,
            'margin_left' => 0,
            'margin_right' => 0,
            'format' => [80, 160], // 80mm de ancho, 190mm de alto (ajustable)
            'orientation' => 'P'
        ]);

        return $pdf->stream('ticketNum' . $prestamo->id . '.pdf');
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
        $equiposOcupados = Inventario::all()->where('tipo', '=', 'Equipo');
        $equiposDisponibles = Inventario::all()->where('tipo', '=', 'Equipo')->where('estado', '=', 'Disponible');
        $aulas = Aula::all();
        $carreras = Carrera::all();
        $asignaturas = Asignatura::all();

        return view('administration.prestamos-records', compact('usuarios', 'equiposOcupados', 'aulas', 'equiposDisponibles', 'carreras', 'asignaturas'));
    }

    public function registro_usuarios()
    {
        $departamentos = Departamento::all();
        $carreras = Carrera::all();

        return view('administration.users-records', compact('departamentos', 'carreras'));
    }

    public function registro_equipos()
    {
        $licencias =Licencia::all();

        return view('administration.equipos-records', compact('licencias'));
    }

    public function registro_licencias()
    {
        $inventario =Inventario::all();

        return view('administration.licencias-records', compact('inventario'));
    }

    public function registro_accesorios()
    {
        return view('administration.accesorios-records');
    }

    public function registro_dispositivo()
    {
        return view('administration.dispositivos-records');
    }
}
