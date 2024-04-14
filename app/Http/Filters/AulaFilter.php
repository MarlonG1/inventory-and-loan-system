<?php

namespace App\Http\Filters;

class AulaFilter extends ApiFilter
{
    protected $safeParams=[
        'aula' => ['eq', 'nt'],
    ];

    protected $operatoMap=[
        'eq' => '=',
        'ne' => '!=',
    ];
}


