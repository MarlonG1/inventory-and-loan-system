<?php

namespace Database\Seeders;

use App\Models\PrestamoHistorico;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Prestamo;
use App\Models\Usuario;

class PrestamoHistoricoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $prestamos = Prestamo::all();

        $prestamos->each(function ($prestamo) {
            $prestamoHistorico = new PrestamoHistorico([
                'prestamo_id' => $prestamo->id,
                'aula_id' => $prestamo->aula_id,
                'user_id' => $prestamo->user_id,
                'asignatura' => $prestamo->asignatura,
                'motivo' => $prestamo->motivo,
                'fecha_prestamo' => $prestamo->fecha_prestamo,
                'hora_inicio' => $prestamo->hora_inicio,
                'hora_fin' => $prestamo->hora_fin,
            ]);

            $prestamoHistorico->save();
            $equipos = $prestamo->equipos;

            $equiposConDatos = [];
            foreach ($equipos as $equipo) {
                $equiposConDatos[$equipo->id] = [
                    'estado' => $equipo->estado,
                    'identificador' => $equipo->identificador,
                ];
            }

            $prestamoHistorico->equipos()->attach($equiposConDatos);
        });
    }

}
