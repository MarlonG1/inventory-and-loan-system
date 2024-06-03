<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InventarioResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'prestamoId' => $this->prestamo_id,
            'marca' => $this->marca,
            'modelo' => $this->modelo,
            'identificador' => $this->identificador,
            'estado' => $this->estado,
            'unidad' => $this->unidad,
            'observaciones' => $this->observaciones,
            'imagen' => $this->imagen,
            'licencias' => LicenciaResource::collection($this->whenLoaded('licencias')),
            'prestamo' => new PrestamoResource($this->whenLoaded('prestamo')),
        ];
    }
}
