<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
            'departamentoId' => ['required'],
            'carreraId' => ['required'],
            'name' => ['required'],
            'lastname' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
            'type' => ['required', Rule::in(['Estudiante', 'Docente', 'Administrador'])],
            'phone' => ['required'],
            'carnet' => ['required'],
            'birthDate' => ['required'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'birth_date' => $this->birthDate,
            'departamento_id' => $this->departamentoId,
            'carrera_id' => $this->carreraId,
        ]);
    }
}
