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
            'marca' => $this->faker->randomElement(['HP', 'Dell', 'Apple', 'Lenovo', 'Asus', 'Acer', 'Samsung', 'Sony', 'Toshiba', 'MSI', 'Alienware', 'Compaq', 'Gateway', 'IBM', 'LG', 'Microsoft', 'Panasonic', 'Razer', 'Vizio', 'Xiaomi']),
            'modelo' => $this->faker->words(1, true),
            'identificador' => $this->faker->unique()->numerify('####-PC-###'),
            'estado' => $this->faker->randomElement(['Disponible', 'En reparación', 'Ocupado']),
            'observaciones' => $this->faker->sentence(5),
            'imagen' => $this->faker->imageUrl(640, 480, 'animals', true),
        ];
    }
}
