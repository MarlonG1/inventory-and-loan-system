<?php

namespace Database\Factories;

use App\Models\Carrera;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarreraFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->randomElement(['Ingeniería en Sistemas', 'Ingeniería en Electrónica', 'Ingeniería en Mecatrónica', 'Ingeniería en Informática', 'Ingeniería en Telecomunicaciones', 'Ingeniería en Redes', 'Ingeniería en Software', 'Ingeniería en Computación', 'Ingeniería en Cibernética', 'Ingeniería en Telemática', 'Ingeniería en Computación en Redes', 'Ingeniería en Computación en Informática', 'Ingeniería en Computación en Software', 'Ingeniería en Computación en Cibernética', 'Ingeniería en Computación en Telemática', 'Ingeniería en Computación en Telecomunicaciones', 'Ingeniería en Computación en Electrónica', 'Licenciatura en Mercadeo Internacional', 'Licenciatura en Ciencias Juridicas', 'Licenciatura en Idioma Ingles']),
            'codigo' => $this->faker->numerify('####-CR-###'),
        ];
    }
}
