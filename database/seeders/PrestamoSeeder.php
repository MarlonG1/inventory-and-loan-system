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
            ->count(20)
            ->for(User::factory())
            ->hasInventario(3)
            ->create()
            ->each(function ($prestamo) use ($aulas, $asignaturas) {
                $prestamo->aula_id = $aulas->random()->id;
                $prestamo->asignatura_id = $asignaturas->random()->id;
                $prestamo->save();

                $prestamo->inventario->each(function ($inventario) {
                    $inventario->tipo = 'Equipo';
                    $inventario->marca = 'HP';
                    $inventario->estado = 'Ocupado';
                    $inventario->save();
                });
            });

        Prestamo::factory()
            ->count(30)
            ->for(User::factory())
            ->hasInventario(3)
            ->create()
            ->each(function ($prestamo) use ($aulas, $asignaturas) {
                $prestamo->aula_id = $aulas->random()->id;
                $prestamo->asignatura_id = $asignaturas->random()->id;
                $prestamo->save();

                $prestamo->inventario->each(function ($inventario) {
                    $inventario->tipo = 'Equipo';
                    $inventario->marca = 'Dell';
                    $inventario->estado = 'Ocupado';
                    $inventario->save();
                });
            });

        Prestamo::factory()
            ->count(30)
            ->for(User::factory())
            ->hasInventario(3)
            ->create()
            ->each(function ($prestamo) use ($aulas, $asignaturas) {
                $prestamo->aula_id = $aulas->random()->id;
                $prestamo->asignatura_id = $asignaturas->random()->id;
                $prestamo->save();

                $prestamo->inventario->each(function ($inventario) {
                    $inventario->tipo = 'Equipo';
                    $inventario->marca = 'Apple';
                    $inventario->estado = 'Ocupado';
                    $inventario->save();
                });
            });

        Prestamo::factory()
            ->count(25)
            ->for(User::factory())
            ->hasInventario(2)
            ->create()
            ->each(function ($prestamo) use ($aulas, $asignaturas) {
                $prestamo->aula_id = $aulas->random()->id;
                $prestamo->asignatura_id = $asignaturas->random()->id;
                $prestamo->save();

                $prestamo->inventario->each(function ($inventario) {
                    $inventario->tipo = 'Accesorio';
                    $inventario->marca = 'Teclado';
                    $inventario->estado = 'Ocupado';
                    $inventario->save();
                });
            });

        Prestamo::factory()
            ->count(10)
            ->for(User::factory())
            ->hasInventario(4)
            ->create()
            ->each(function ($prestamo) use ($aulas, $asignaturas) {
                $prestamo->aula_id = $aulas->random()->id;
                $prestamo->asignatura_id = $asignaturas->random()->id;
                $prestamo->save();

                $prestamo->inventario->each(function ($inventario) {
                    $inventario->tipo = 'Dispositivo';
                    $inventario->marca = 'Epson';
                    $inventario->estado = 'Ocupado';
                    $inventario->save();
                });
            });
    }
}
