<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestamoHistorico extends Model
{
    use HasFactory;

    public function equipos()
    {
//        return $this->belongsToMany(Equipo::class, 'equipo_prestamo_historico');

        return $this->belongsToMany(Equipo::class)
            ->withPivot('prestamo_historico_id', 'equipo_id', 'estado', 'identificador');

//        return $this->belongsToMany(Equipo::class,
//            'equipo_prestamo_historico',
//            'prestamo_historico_id',
//            'equipo_id')
//            ->withPivot(['estado', 'identificador'])
//            ->withTimestamps();
    }

}
