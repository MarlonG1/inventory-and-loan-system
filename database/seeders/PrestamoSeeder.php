<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Prestamo;
use App\Models\Usuario;

class PrestamoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Prestamo::factory()
            ->count(100)
            ->for(Usuario::factory())
            ->hasEquipos(3)
            ->create();
        Prestamo::factory()
            ->count(25)
            ->for(Usuario::factory())
            ->hasEquipos(2)
            ->create();
        Prestamo::factory()
            ->count(10)
            ->for(Usuario::factory())
            ->hasEquipos(4)
            ->create();
    }
}
