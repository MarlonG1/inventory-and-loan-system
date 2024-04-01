<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id',
        'asignatura',
        'motivo',
        'estado',
        'fecha_prestamo',
        'hora_inicio',
        'hora_fin',
    ];

    //me quede en esta wea que no esta funcionando xd
    protected static function booted()
    {
        static::saved(function ($prestamo) {
//            $prestamo->load('equipos');
            $prestamoHistorico = new PrestamoHistorico([
                'prestamo_id' => $prestamo->id,
                'usuario_id' => $prestamo->usuario_id,
                'asignatura' => $prestamo->asignatura,
                'motivo' => $prestamo->motivo,
                'fecha_prestamo' => $prestamo->fecha_prestamo,
                'hora_inicio' => $prestamo->hora_inicio,
                'hora_fin' => $prestamo->hora_fin,
            ]);
            $prestamoHistorico->save();

            foreach ($prestamo->equipos as $equipo) {
                $prestamoHistorico->equipos()->attach($equipo->id, [
                    'estado' => $equipo->estado,
                    'identificador' => $equipo->identificador,
                ]);
            }

//            $equiposConDatos = [];
//            foreach ($prestamo->equipos as $equipo) {
//                $equiposConDatos[$equipo->id] = [
//                    'estado' => $equipo->estado,
//                    'identificador' => $equipo->identificador,
//                ];
//            }
//
//            $prestamoHistorico->equipos()->attach($equiposConDatos);
        });
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function equipos()
    {
        return $this->hasMany(Equipo::class);
    }

    //Me quede aqui
    public function configure()
    {
        return $this->afterCreating(function (Prestamo $prestamo) {
            // Asociar equipos al préstamo
            $equipos = Equipo::factory()->count(3)->create(); // Cambia el count según tus necesidades
            $prestamo->equipos()->saveMany($equipos);
        });
    }
}
