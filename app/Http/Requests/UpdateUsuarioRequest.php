<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUsuarioRequest extends FormRequest
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
      if ($method == 'PUT'){
          return[
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
      } else {
          return[
              'nombre' => ['sometimes', 'required'],
              'apellido' => ['sometimes', 'required'],
              'tipo' => ['sometimes', 'required', Rule::in(['Estudiante', 'Docente', 'Administrador'])],
              'correo' => ['sometimes', 'required', 'email'],
              'contrasena' => ['sometimes', 'required'],
              'telefono' => ['sometimes', 'required'],
              'dui' => ['sometimes', 'required'],
              'carnet' => ['sometimes', 'required'],
              'fechaNacimiento' => ['sometimes', 'required'],
          ];
      }
    }
    protected function prepareForValidation()
    {
        if ($this->postalCode){
            $this->merge([
                'fecha_nacimiento' => $this->fechaNacimiento
            ]);
        }
    }
}
