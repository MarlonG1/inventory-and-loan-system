<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Usuario;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Usuario::factory()->count(50)
            ->hasPrestamos(3)
            ->create();
        Usuario::factory()->count(50)
            ->hasPrestamos(2)
            ->create();
        Usuario::factory()->count(50)
            ->hasPrestamos(3)
            ->create();

    }
}
