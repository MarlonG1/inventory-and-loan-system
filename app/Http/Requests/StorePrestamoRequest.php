<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePrestamoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'usuarioId' => ['required'],
            'asignatura' => ['required'],
            'motivo' => ['required'],
            'estado' => ['required', Rule::in(['Activo', 'Pendiente', 'Finalizado'])],
            'fechaPrestamo' => ['required'],
            'horaInicio' => ['required'],
            'horaFin' => ['required'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'usuario_id' => $this->usuarioId,
            'fecha_prestamo' => $this->fechaPrestamo,
            'hora_inicio' => $this->horaInicio,
            'hora_fin' => $this->horaFin
        ]);
    }
}
