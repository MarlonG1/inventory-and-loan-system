<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'tipo' => $this->faker->name(),
            'clave' => $this->faker->phoneNumber(),
            'estado' => $this->faker->randomElement(['Activa', 'Por renovar', 'Inactiva', 'Vencida']),
            'unidad' => 100,
            'observaciones' => $this->faker->name(),
            'fecha_adquisicion' => $this->faker->date(),
            'fecha_vencimiento' => $this->faker->date(),
        ];
    }
}
