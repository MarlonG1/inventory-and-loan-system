<?php

namespace App\Http\Filters;

class UsuarioFilter extends ApiFilter
{
    protected $safeParams=[
        'nombre' => ['eq'],
        'apellido' => ['eq'],
        'tipo' => ['eq'],
        'correo' => ['eq'],
        'telefono' => ['eq'],
        'dui' => ['eq'],
        'carnet' => ['eq'],
        'fechaNacimiento' => ['eq', 'gt', 'lt', 'lte', 'gte'],
    ];
    protected $columnMap=[
        'fechaNacimiento' => 'fecha_nacimiento',
    ];
    protected $operatoMap=[
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
    ];
}


