<?php

namespace App\Models;

use App\Http\Interfaces\ISearch;
use App\Http\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model implements ISearch
{
    use HasFactory, SearchTrait;

    protected $table = 'inventario';
    protected $fillable = [
            'prestamo_id',
            'marca',
            'modelo',
            'tipo',
            'identificador',
            'estado',
            'observaciones',
            'imagen',
    ];

    //Atributos para la busqueda
    protected $model = self::class;
    protected $relations = ['prestamo', 'licencias'];
    protected array $tables = ['inventario', 'prestamos', 'inventario_licencias'];
    protected array $fields = [
        'inventario' => ['marca', 'modelo', 'identificador', 'estado'],
        'prestamos' => [],
        'licencias' => [],
    ];
    protected array $joins = [
        [
            'table' => 'prestamos',
            'firstKey' => 'prestamos.id',
            'secondKey' => 'equipo.prestamo_id',
        ],
        [
            'table' => 'inventario_licencias',
            'firstKey' => 'inventario_licencias.inventario_id',
            'secondKey' => 'inventario.id',
        ],
    ];

    public function licencias()
    {
        return $this->belongsToMany(Licencia::class, 'inventario_licencias');
    }

    public function prestamo()
    {
        return $this->belongsTo(Prestamo::class);
    }

    public function prestamoHistoricos()
    {
//        return $this->belongsToMany(PrestamoHistorico::class,'equipo_prestamo_historico');
        return $this->belongsToMany(PrestamoHistorico::class,
            'inventario_prestamo_historico',
            'inventario_id',
            'prestamo_historico_id')
            ->withPivot(['estado', 'identificador'])
            ->withTimestamps();
    }

    function getModel()
    {
        return $this->model;
    }

    function getTables(): array
    {
        return $this->tables;
    }

    function getFields(): array
    {
        return $this->fields;
    }

    function getJoins(): array
    {
        return $this->joins;
    }

    function getRelations(): array
    {
        return $this->relations;
    }
}
