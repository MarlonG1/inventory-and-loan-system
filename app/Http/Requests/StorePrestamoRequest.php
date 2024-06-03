<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Validation\Rule;

class StorePrestamoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        $user = $this->user();
        return $user != null && $user->tokenCan('create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'userId' => ['required'],
            'aulaId' => ['required'],
            'asignaturaId' => ['required'],
            'estado' => ['required', Rule::in(['Activo', 'Pendiente', 'Finalizado'])],
            'fechaPrestamo' => ['required'],
            'horaInicio' => ['required'],
            'horaFin' => ['required'],
        ];
    }

    protected function prepareForValidation() : void
    {
        $this->merge([
            'user_id' => $this->userId,
            'aula_id' => $this->aulaId,
            'asignatura_id' => $this->asignaturaId,
            'fecha_prestamo' => $this->fechaPrestamo,
            'hora_inicio' => $this->horaInicio,
            'hora_fin' => $this->horaFin
        ]);
    }
}
