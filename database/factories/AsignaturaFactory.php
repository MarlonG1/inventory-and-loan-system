<?php

namespace Database\Factories;

use App\Models\Asignatura;
use Illuminate\Database\Eloquent\Factories\Factory;

class AsignaturaFactory extends Factory
{
    protected $model = Asignatura::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->randomElement(['Programación con Bases de Datos', 'Diseño de paginas web', 'Programación de aplicaciones móviles', 'Programación de aplicaciones web', 'Programación de sistemas', 'Filosofia', 'Estadistica', 'Matematica 1', 'Fisica', 'Quimica', 'Biologia', 'Matematica 2', 'Matematica 3', 'Matematica 4']),
            'codigo' => $this->faker->numerify('####-SG-###'),
        ];
    }
}
