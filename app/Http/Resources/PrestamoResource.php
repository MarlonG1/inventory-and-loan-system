<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PrestamoResource extends JsonResource
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
            'usuarioId' => $this->usuario_id,
            'asignatura' => $this->asignatura,
            'motivo' => $this->motivo,
            'estado' => $this->estado,
            'fechaPrestamo' => $this->fecha_prestamo,
            'horaInicio' => $this->hora_inicio,
            'horaFin' => $this->hora_fin,
            'equipos' => EquipoResource::collection($this->whenLoaded('equipos'))
        ];
    }
}
