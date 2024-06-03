<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePrestamoRequest extends FormRequest
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
        $method = $this->method();
        if ($method == 'PUT') {
            return [
                'userId' => ['required'],
                'aulaId' => ['required'],
                'asignaturaId' => ['required'],
                'fechaPrestamo' => ['required'],
                'horaInicio' => ['required'],
                'horaFin' => ['required'],
            ];
        } else {
            return [
                'userId' => ['sometimes', 'required'],
                'aulaId' => ['sometimes', 'required'],
                'asignaturaId' => ['sometimes', 'required'],
                'estado' => ['sometimes', 'required', Rule::in(['Activo', 'Pendiente', 'Finalizado'])],
                'fechaPrestamo' => ['sometimes', 'required'],
                'horaInicio' => ['sometimes', 'required'],
                'horaFin' => ['sometimes', 'required'],
            ];
        }
    }

    protected function prepareForValidation() : void
    {
        $camposRequest = ['userId', 'aulaId', 'asignaturaId', 'fechaPrestamo', 'horaInicio', 'horaFin'];
        $camposBD = ['user_id', 'aula_id', 'asignatura_id', 'fecha_prestamo', 'hora_inicio', 'hora_fin'];

        foreach ($camposRequest as $key => $value) {
            if ($this->$value) {
                $this->merge([
                    $camposBD[$key] => $this->$value
                ]);
            }
        }
    }
}
