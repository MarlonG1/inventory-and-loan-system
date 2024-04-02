<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;
    protected $fillable = [
            'prestamo_id',
            'marca',
            'modelo',
            'identificador',
            'estado',
            'unidad',
            'observaciones',
    ];

    public function licencias()
    {
        return $this->belongsToMany(Licencia::class, 'equipo_licencias');
    }

    public function prestamo()
    {
        return $this->belongsTo(Prestamo::class);
    }

    public function prestamoHistoricos()
    {
//        return $this->belongsToMany(PrestamoHistorico::class,'equipo_prestamo_historico');
        return $this->belongsToMany(PrestamoHistorico::class,
            'equipo_prestamo_historico',
            'equipo_id',
            'prestamo_historico_id')
            ->withPivot(['estado', 'identificador'])
            ->withTimestamps();
    }

}
