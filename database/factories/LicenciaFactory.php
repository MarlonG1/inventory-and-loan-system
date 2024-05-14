<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Licencia>
 */
class LicenciaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->name(),
            'tipo' => $this->faker->randomElement(['Antivirus', 'Sistema operativo', 'Sistema contable', 'Ofimática', 'Diseño gráfico', 'Programación', 'Base de datos']),
            'clave' => Hash::make($this->faker->uuid()),
            'estado' => $this->faker->randomElement(['Activa', 'Por renovar', 'Inactiva', 'Vencida']),
            'unidad' => 100,
            'observaciones' => $this->faker->sentence(5),
            'fecha_adquisicion' => $this->faker->date(),
            'fecha_vencimiento' => $this->faker->date(),
        ];
    }
}
