<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AulaSeeder::class,
            CarreraSeeder::class,
            AsignaturaSeeder::class,
            DepartamentoSeeder::class,
            UserSeeder::class,
            PrestamoSeeder::class,
            InventarioSeeder::class,
            LicenciaSeeder::class,
            PrestamoHistoricoSeeder::class,
        ]);
    }
}
