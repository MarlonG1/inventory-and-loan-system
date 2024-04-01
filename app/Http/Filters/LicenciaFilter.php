<?php

namespace App\Http\Filters;

class LicenciaFilter extends ApiFilter
{
    protected $safeParams=[
        'nombre' => ['eq'],
        'tipo' => ['eq', 'ne'],
        'estado' => ['eq'],
        'unidad' => ['eq', 'gt', 'lt', 'lte', 'gte'],
        'fechaAdquisicion' => ['eq', 'gt', 'lt', 'lte', 'gte'],
        'fechaVencimiento' => ['eq', 'gt', 'lt', 'lte', 'gte'],
    ];
    protected $columnMap=[
        'fechaAdquisicion' => 'fecha_adquisicion',
        'fechaVencimiento' => 'fecha_vencimiento',
    ];
    protected $operatoMap=[
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
        'ne' => '!=',
    ];
}


