<?php

namespace Database\Factories;

use App\Models\Inventario;
use App\Models\Licencia;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EquipoLicencia>
 */
class EquipoLicenciaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'fecha_asignacion' => '2021-10-10',
            'estado' => $this->faker->randomElement(['Activo', 'Inactivo']),
            'observaciones' => $this->faker->sentence(5)(),
        ];
    }
}
