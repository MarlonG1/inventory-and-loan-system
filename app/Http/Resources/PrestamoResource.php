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
            'userId' => $this->user_id,
            'aulaId' => $this->aula_id,
            'asignatura' => $this->asignatura,
            'motivo' => $this->motivo,
            'estado' => $this->estado,
            'fechaPrestamo' => $this->fecha_prestamo,
            'horaInicio' => $this->hora_inicio,
            'horaFin' => $this->hora_fin,
            'user' => new UserResource($this->whenLoaded('user')),
            'equipos' => EquipoResource::collection($this->whenLoaded('equipos'))
        ];
    }
}
