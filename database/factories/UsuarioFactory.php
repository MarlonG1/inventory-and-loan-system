<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UsuarioFactory extends Factory
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
            'apellido' => $this->faker->name(),
            'tipo' => $this->faker->randomElement(['Estudiante', 'Docente', 'Administrador']),
            'correo' => $this->faker->unique()->safeEmail(),
            'contrasena' => $this->faker->password(),
            'telefono' => $this->faker->phoneNumber(),
            'dui' => $this->faker->phoneNumber(),
            'carnet' => $this->faker->phoneNumber(),
            'fecha_nacimiento' => $this->faker->date(),
            'imagen' => $this->faker->imageUrl(),
        ];
    }
}
