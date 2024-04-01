<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUsuarioRequest extends FormRequest
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
            'nombre' => ['required'],
            'apellido' => ['required'],
            'tipo' => ['required', Rule::in(['Estudiante', 'Docente', 'Administrador'])],
            'correo' => ['required', 'email'],
            'contrasena' => ['required'],
            'telefono' => ['required'],
            'dui' => ['required'],
            'carnet' => ['required'],
            'fechaNacimiento' => ['required'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'fecha_nacimiento' => $this->fechaNacimiento
        ]);
    }
}
