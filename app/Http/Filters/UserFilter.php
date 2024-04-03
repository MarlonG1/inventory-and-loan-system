<?php

namespace App\Http\Filters;

class UserFilter extends ApiFilter
{
    protected $safeParams=[
        'name' => ['eq'],
        'lastname' => ['eq'],
        'email' => ['eq'],
        'password' => ['eq'],
        'type' => ['eq'],
        'phone' => ['eq'],
        'dui' => ['eq'],
        'carnet' => ['eq'],
        'birthDate' => ['eq', 'gt', 'lt', 'lte', 'gte'],
        'image' => ['eq'],
    ];
    protected $columnMap=[
        'birthDate' => 'birth_date',
    ];
    protected $operatoMap=[
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
    ];
}


