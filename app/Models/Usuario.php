<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Usuario extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'apellido',
        'tipo',
        'correo',
        'contrasena',
        'telefono',
        'dui',
        'carnet',
        'fecha_nacimiento',
        'imagen',
    ];

    public function prestamos()
    {
        return $this->hasMany(Prestamo::class);
    }

}
