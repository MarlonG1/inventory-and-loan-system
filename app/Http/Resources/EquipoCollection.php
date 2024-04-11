<?php

namespace App\Http\Resources;

use App\Models\Equipo;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EquipoCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $array = parent::toArray($request);

        $total = [
            'totalDeEquipos' => Equipo::all()->count(),
        ];

        $result = [
            'equipos' => $array,
            'totales' => $total
        ];

        return $result;
    }
}
