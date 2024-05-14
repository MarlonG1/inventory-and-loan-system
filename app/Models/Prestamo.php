<?php

namespace App\Models;

use App\Http\Resources\PrestamoResource;
use App\Http\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Prestamo extends Model
{
    use HasFactory;
    use SearchTrait;

    protected $fillable = [
        'user_id',
        'aula_id',
        'carrera_id',
        'asignatura_id',
        'motivo',
        'estado',
        'fecha_prestamo',
        'hora_inicio',
        'hora_fin',
    ];

    protected $model = self::class;
    protected $relations = ['user', 'equipos', 'asignatura'];

    //me quede en esta wea que no esta funcionando xd
//    protected static function booted()
//    {
//        static::saved(function ($prestamo) {
//           $prestamo->load('equipos');
//            $prestamoHistorico = new PrestamoHistorico([
//                'prestamo_id' => $prestamo->id,
//                'user_id' => $prestamo->user_id,
//                'asignatura' => $prestamo->asignatura,
//                'motivo' => $prestamo->motivo,
//                'fecha_prestamo' => $prestamo->fecha_prestamo,
//                'hora_inicio' => $prestamo->hora_inicio,
//                'hora_fin' => $prestamo->hora_fin,
//            ]);
//            $prestamoHistorico->save();
//
//            $equiposConDatos = [];
//            foreach ($prestamo->equipos as $equipo) {
//                $equiposConDatos[$equipo->id] = [
//                    'estado' => $equipo->estado,
//                    'identificador' => $equipo->identificador,
//                ];
//            }
//
//            $prestamoHistorico->equipos()->attach($equiposConDatos);
//        });
//    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function aula() : BelongsTo
    {
        return $this->belongsTo(Aula::class);
    }

    public function equipos() : HasMany
    {
        return $this->hasMany(Equipo::class);
    }

    public function carrera() : BelongsTo
    {
        return $this->belongsTo(Carrera::class);
    }

    public function asignatura() : BelongsTo
    {
        return $this->belongsTo(Asignatura::class);
    }

    //Metodos de objeto

    public function getModel()
    {
        return app($this->model);
    }

    public function getRelations()
    {
        return property_exists($this, 'relations') ? $this->relations : [];
    }

    //Me quede aqui
//    public function configure()
//    {
//        return $this->afterCreating(function (Prestamo $prestamo) {
//            // Asociar equipos al préstamo
//            $equipos = Equipo::factory()->count(3)->create();
//            $prestamo->equipos()->saveMany($equipos);
//        });
//    }
}
