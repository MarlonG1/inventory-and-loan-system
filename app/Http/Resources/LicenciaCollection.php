<?php

namespace App\Http\Resources;

use App\Models\Licencia;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class LicenciaCollection extends ResourceCollection
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
            'totalDeLicencias' => Licencia::all()->count(),
        ];

        $result = [
            'licencias' => $array,
            'totales' => $totales
        ];

        return $result;
    }
}
