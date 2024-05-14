<?php

namespace Database\Seeders;

use App\Models\Aula;
use App\Models\Departamento;
use Illuminate\Database\Seeder;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departamentos = [
            'Ahuachapán',
            'Cabañas',
            'Chalatenango',
            'Cuscatlán',
            'La Libertad',
            'La Paz',
            'La Unión',
            'Morazán',
            'San Miguel',
            'San Salvador',
            'San Vicente',
            'Santa Ana',
            'Sonsonate',
            'Usulután'
        ];

        for ($i = 0; $i < count($departamentos); $i++) {
            $departamento = new Departamento([
                'nombre' => $departamentos[$i]
            ]);
            $departamento->save();
        }
    }
}
