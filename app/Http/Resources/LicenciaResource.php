<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LicenciaResource extends JsonResource
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
            'nombre' => $this->nombre,
            'tipo' => $this->tipo,
            'clave' => $this->clave,
            'estado' => $this->estado,
            'unidad' => $this->unidad,
            'observaciones' => $this->observaciones,
            'fechaAdquisicion' => $this->fecha_adquisicion,
            'fechaVencimiento' => $this->fecha_vencimiento,
            'equipos' => InventarioResource::collection($this->whenLoaded('equipos'))
        ];
    }
}
