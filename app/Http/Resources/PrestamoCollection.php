<?php

namespace App\Http\Resources;

use App\Models\Prestamo;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PrestamoCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $array = parent::toArray($request);

        $totales = [
            'totalDeActivos' => Prestamo::all()->where('estado', '=', 'Activo')->count(),
            'totalDePendientes' => Prestamo::all()->where('estado', '=', 'Pendiente')->count(),
            'totalDeFinalizados' => Prestamo::all()->where('estado', '=', 'Finalizado')->count(),
        ];

        $result = [
            'prestamos' => $array,
            'totales' => $totales
        ];

        return $result;
//        return parent::toArray($request);
    }
}
