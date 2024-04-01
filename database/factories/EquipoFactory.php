<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipo>
 */
class EquipoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'marca' => $this->faker->name(),
            'modelo' => $this->faker->name(),
            'identificador' => $this->faker->name(),
            'estado' => $this->faker->randomElement(['Disponible', 'En reparación', 'Ocupado']),
            'unidad' => 100,
            'observaciones' => $this->faker->name(),
        ];
    }
}
