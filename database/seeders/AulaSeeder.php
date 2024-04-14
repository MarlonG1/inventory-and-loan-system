<?php

namespace Database\Seeders;

use App\Models\Aula;
use Illuminate\Database\Seeder;

class AulaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aulas = [
            'A',
            'B',
            'C',
            'D'
        ];

        for ($i = 0; $i < count( $aulas); $i++){
            for ($j = 1; $j <= 36; $j++){
                $aula = new Aula([
                    'aula' => $aulas[$i] . '-' . $j,
                ]);
                $aula->save();
            }
        }
    }
}
