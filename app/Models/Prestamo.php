<?php

namespace App\Models;

use App\Http\Resources\PrestamoResource;
use App\Http\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Http\Interfaces\ISearch;

class Prestamo extends Model implements ISearch
{
    use HasFactory;
    use SearchTrait;

    protected $fillable = [
        'user_id',
        'aula_id',
        'asignatura_id',
        'motivo',
        'estado',
        'fecha_prestamo',
        'hora_inicio',
        'hora_fin',
    ];

    protected $model = self::class;
    protected $relations = ['user', 'inventario', 'asignatura'];

    //Atributos usados para la busqueda
    protected array $tables = ['prestamos', 'users', 'inventario', 'asignaturas'];
    protected array $fields = [
        'prestamos' => ['estado'],
        'users' => ['name', 'lastname'],
        'inventario' => [],
        'asignaturas' => ['nombre'],
    ];

    protected array $joins = [
        [
            'table' => 'users',
            'firstKey' => 'prestamos.user_id',
            'secondKey' => 'users.id',
        ],
        [
            'table' => 'inventario',
            'firstKey' => 'prestamos.id',
            'secondKey' => 'inventario.prestamo_id',
        ],
        [
            'table' => 'asignaturas',
            'firstKey' => 'prestamos.asignatura_id',
            'secondKey' => 'asignaturas.id',
        ],
    ];
    //Fin atributos usados para la busqueda

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function aula() : BelongsTo
    {
        return $this->belongsTo(Aula::class);
    }

    public function inventario() : HasMany
    {
        return $this->hasMany(Inventario::class);
    }

    public function asignatura() : BelongsTo
    {
        return $this->belongsTo(Asignatura::class);
    }

    //Metodos de interfaz ISearch

    public function getModel()
    {
        return app($this->model);
    }

    public function getRelations(): array
    {
        return property_exists($this, 'relations') ? $this->relations : [];
    }

    public function getTables(): array
    {
        return $this->tables;
    }

    public function getFields(): array
    {
        return $this->fields;
    }

    public function getJoins(): array
    {
        return $this->joins;
    }
}
