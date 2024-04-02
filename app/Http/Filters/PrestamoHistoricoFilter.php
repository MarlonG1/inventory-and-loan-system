<?php

namespace App\Http\Filters;

class PrestamoHistoricoFilter extends ApiFilter
{
    protected $safeParams=[
        'prestamoId' => ['eq', 'gt', 'lt'],
        'usuarioId' => ['eq', 'gt', 'lt'],
        'asignatura' => ['eq'],
        'estado' => ['eq'],
        'fechaPrestamo' => ['eq', 'gt', 'lt', 'lte', 'gte'],
        'horaInicio' => ['eq', 'gt', 'lt', 'lte', 'gte'],
        'horaFin' => ['eq', 'gt', 'lt', 'lte', 'gte'],
    ];
    protected $columnMap=[
        'prestamoId' => 'prestamo_id',
        'usuarioId' => 'usuario_id',
        'fechaPrestamo' => 'fecha_prestamo',
        'horaInicio' => 'hora_inicio',
        'horaFin' => 'hora_fin',
    ];
    protected $operatoMap=[
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
    ];
}


