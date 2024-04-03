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
                'asignatura' => ['required'],
                'motivo' => ['required'],
                'estado' => ['required', Rule::in(['Activo', 'Pendiente', 'Finalizado'])],
                'fechaPrestamo' => ['required'],
                'horaInicio' => ['required'],
                'horaFin' => ['required'],
            ];
        } else {
            return [
                'userId' => ['sometimes', 'required'],
                'asignatura' => ['sometimes', 'required'],
                'motivo' => ['sometimes', 'required'],
                'estado' => ['sometimes', 'required', Rule::in(['Activo', 'Pendiente', 'Finalizado'])],
                'fechaPrestamo' => ['sometimes', 'required'],
                'horaInicio' => ['sometimes', 'required'],
                'horaFin' => ['sometimes', 'required'],
            ];
        }
    }

    protected function prepareForValidation()
    {
        $camposRequest = ['userId', 'fechaPrestamo', 'horaInicio', 'horaFin'];
        $camposBD = ['user_id', 'fecha_prestamo', 'hora_inicio', 'hora_fin'];

        foreach ($camposRequest as $key => $value) {
            if ($this->$value) {
                $this->merge([
                    $camposBD[$key] => $this->$value
                ]);
            }
        }
    }
}
