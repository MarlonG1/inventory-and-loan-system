<?php

namespace App\Http\Filters;
use Illuminate\Http\Request;

class ApiFilter
{
    //Parametros para filtrar los modelos
    protected $safeParams=[];
    //Mapear columnas de la base de datos
    protected $columnMap=[];
    //Mapear operadores
    protected $operatoMap=[];

    public function transform(Request $request)
    {
        $eloquery = [];
        foreach($this->safeParams as $param => $operators){
            $query = $request->query($param);
            if(!isset($query)){
                continue;
            }
            $column = $this->columnMap[$param] ?? $param;
            foreach ($operators as $operator){
                if (isset($query[$operator])){
                    $eloquery[] = [$column, $this->operatoMap[$operator], $query[$operator]];
                }
            }
        }
        return $eloquery;
    }
}
