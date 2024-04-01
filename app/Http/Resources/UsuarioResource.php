<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UsuarioResource extends JsonResource
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
            'apellido' => $this->apellido,
            'tipo' => $this->tipo,
            'correo' => $this->correo,
            'contraseña' => $this->contrasena,
            'telefono' => $this->telefono,
            'dui' => $this->dui,
            'carnet' => $this->carnet,
            'fechaNacimiento' => $this->fecha_nacimiento,
            'imagen' => $this->imagen,
            'prestamos' => PrestamoResource::collection($this->whenLoaded('prestamos'))
        ];
    }
}
