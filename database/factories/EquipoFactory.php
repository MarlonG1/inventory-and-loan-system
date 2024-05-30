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
            'marca' => $this->faker->randomElement(['HP', 'Apple', 'Sony', 'Dell', 'Compaq']),
            'modelo' => $this->faker->words(1, true),
            'identificador' => $this->faker->unique()->numerify('####-PC-###'),
            'estado' => $this->faker->randomElement(['Disponible', 'En reparación', 'Ocupado']),
            'observaciones' => $this->faker->sentence(5),
            'imagen' => "https://4.imimg.com/data4/HG/DM/MY-9532529/laptop-computer.jpg",
        ];
    }
}
