<?php

namespace Database\Seeders;

use App\Models\Prestamo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Inventario;


class InventarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Inventario::factory()
            ->count(200)
            ->hasLicencias(3)
            ->create()
            ->each(function ($inventario) {
                $inventario->tipo = 'Equipo';
                $inventario->marca = 'HP';
                $inventario->estado = 'Disponible';
                $inventario->save();
            });
        Inventario::factory()
            ->count(75)
            ->hasLicencias(4)
            ->create()
            ->each(function ($inventario) {
                $inventario->tipo = 'Equipo';
                $inventario->marca = 'Dell';
                $inventario->estado = 'Ocupado';
                $inventario->save();
            });
        Inventario::factory()
            ->count(25)
            ->hasLicencias(5)
            ->create()
            ->each(function ($inventario) {
                $inventario->tipo = 'Equipo';
                $inventario->marca = 'Apple';
                $inventario->estado = 'En reparación';
                $inventario->save();
            });

        Inventario::factory()
            ->count(50)
            ->create()
        ->each(function ($inventario) {
            $inventario->tipo = 'Accesorio';
            $inventario->marca = 'Teclado';
            $inventario->estado = 'Disponible';
            $inventario->save();
        });
        Inventario::factory()
            ->count(50)
            ->create()
            ->each(function ($inventario) {
                $inventario->tipo = 'Dispositivo';
                $inventario->marca = 'Epson';
                $inventario->estado = 'Disponible';
                $inventario->save();
            });
    }
}
