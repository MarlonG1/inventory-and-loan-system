<?php

namespace Database\Seeders;

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
        Prestamo::factory()
            ->count(100)
            ->for(User::factory())
            ->hasEquipos(3)
            ->create();
        Prestamo::factory()
            ->count(25)
            ->for(User::factory())
            ->hasEquipos(2)
            ->create();
        Prestamo::factory()
            ->count(10)
            ->for(User::factory())
            ->hasEquipos(4)
            ->create();
    }
}
