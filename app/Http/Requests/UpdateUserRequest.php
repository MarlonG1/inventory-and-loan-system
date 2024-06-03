<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
                'departamento_id' => ['required'],
                'carrera_id' => ['required'],
                'name' => ['required'],
                'lastname' => ['required'],
                'email' => ['required', 'email'],
                'password' => ['required'],
                'type' => ['required', Rule::in(['Estudiante', 'Docente', 'Administrador'])],
                'phone' => ['required'],
                'carnet' => ['required'],
                'birthDate' => ['required'],
            ];
        } else {
            return [
                'departamento_id' => ['sometimes', 'required'],
                'carrera_id' => ['sometimes', 'required'],
                'name' => ['sometimes', 'required'],
                'lastname' => ['sometimes', 'required'],
                'email' => ['sometimes', 'required', 'email'],
                'password' => ['sometimes', 'required'],
                'type' => ['sometimes', 'required', Rule::in(['Estudiante', 'Docente', 'Administrador'])],
                'phone' => ['sometimes', 'required'],
                'carnet' => ['sometimes', 'required'],
                'birthDate' => ['sometimes', 'required'],
            ];
        }
    }

    protected function prepareForValidation()
    {
        $camposRequest = ['birthDate', 'departamentoId', 'carreraId'];
        $camposBD = ['birth_date', 'departamento_id', 'carrera_id'];

        foreach ($camposRequest as $key => $value) {
            if ($this->$value) {
                $this->merge([
                    $camposBD[$key] => $this->$value
                ]);
            }
        }
    }
}
