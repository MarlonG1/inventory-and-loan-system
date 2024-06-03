<?php

namespace App\Models;

use App\Http\Interfaces\ISearch;
use App\Http\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licencia extends Model implements ISearch
{
    use HasFactory, SearchTrait;
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

    //Atributos para la busqueda
    protected $model = self::class;
    protected $relations = ['inventario'];
    protected array $tables = ['licencias', 'inventario_licencias'];
    protected array $fields = [
        'licencias' => ['nombre', 'tipo', 'estado', 'unidad', 'fecha_vencimiento'],
    ];
    protected array $joins = [
        [
            'table' => 'inventario_licencias',
            'firstKey' => 'inventario_licencias.licencia_id',
            'secondKey' => 'licencias.id',
        ]
    ];


    public function inventario()
    {
        return $this->belongsToMany(Inventario::class, 'inventario_licencias');
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
