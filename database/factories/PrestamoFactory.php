<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prestamo>
 */
class PrestamoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'motivo' => $this->faker->paragraph(),
            'estado' => $this->faker->randomElement(['Activo', 'Pendiente', 'Finalizado']),
            'fecha_prestamo' => $this->faker->date(),
            'hora_inicio' => $this->faker->time(),
            'hora_fin' => $this->faker->time(),
        ];
    }
}
