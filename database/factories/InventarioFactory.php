<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventario>
 */
class InventarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'modelo' => $this->faker->words(1, true),
            'identificador' => $this->faker->unique()->numerify('####-PC-###'),
            'observaciones' => $this->faker->sentence(5),
            'imagen' => "https://4.imimg.com/data4/HG/DM/MY-9532529/laptop-computer.jpg" ,
        ];
    }
}
