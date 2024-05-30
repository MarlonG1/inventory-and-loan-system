<?php

namespace Database\Seeders;

use App\Models\Asignatura;
use App\Models\Aula;
use App\Models\Carrera;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Prestamo;

class PrestamoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $asignaturas = Asignatura::all();
        $aulas = Aula::all();

        Prestamo::factory()
            ->count(100)
            ->for(User::factory())
            ->hasEquipos(3)
            ->create()
            ->each(function ($prestamo) use ($aulas, $asignaturas) {
                $prestamo->aula_id = $aulas->random()->id;
                $prestamo->asignatura_id = $asignaturas->random()->id;
                $prestamo->save();
            });

        Prestamo::factory()
            ->count(25)
            ->for(User::factory())
            ->hasEquipos(2)
            ->create()
            ->each(function ($prestamo) use ($aulas, $asignaturas) {
                $prestamo->aula_id = $aulas->random()->id;
                $prestamo->asignatura_id = $asignaturas->random()->id;
                $prestamo->save();
            });

        Prestamo::factory()
            ->count(10)
            ->for(User::factory())
            ->hasEquipos(4)
            ->create()
            ->each(function ($prestamo) use ($aulas, $asignaturas) {
                $prestamo->aula_id = $aulas->random()->id;
                $prestamo->asignatura_id = $asignaturas->random()->id;
                $prestamo->save();
            });
    }
}
