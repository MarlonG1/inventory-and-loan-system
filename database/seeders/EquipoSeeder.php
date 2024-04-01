<?php

namespace Database\Seeders;

use App\Models\Prestamo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Equipo;


class EquipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Equipo::factory()
            ->count(50)
            ->hasLicencias(3)
            ->create();
        Equipo::factory()
            ->count(50)
            ->hasLicencias(4)
            ->create();
        Equipo::factory()
            ->count(25)
            ->hasLicencias(5)
            ->create();
    }
}
