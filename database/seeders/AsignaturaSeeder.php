<?php

namespace Database\Seeders;

use App\Models\Asignatura;
use App\Models\Carrera;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AsignaturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carreras = Carrera::all();

        Asignatura::factory()->count(14)
            ->create()
            ->each(function ($asignatura) use ($carreras) {
                $asignatura->carrera_id = $carreras->random()->id;
                $asignatura->save();
            });
    }
}
