<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licencia extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'tipo',
        'clave',
        'estado',
        'unidad',
        'observaciones',
        'fecha_adquisicion',
        'fecha_vencimiento',
    ];

    public function equipos()
    {
        return $this->belongsToMany(Equipo::class, 'equipo_licencias');
    }
}
