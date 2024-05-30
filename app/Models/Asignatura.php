<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    use HasFactory;

    protected $fillable = [ 'nombre', 'codigo', 'carrera_id'];
    public $timestamps = false;

    public function prestamo()
    {
        return $this->hasMany(Prestamo::class);
    }

    public function carrera()
    {
        return $this->belongsTo(Carrera::class);
    }
}
