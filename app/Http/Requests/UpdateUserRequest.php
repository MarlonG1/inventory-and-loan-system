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
      if ($method == 'PUT'){
          return[
              'name' => ['required'],
              'lastname' => ['required'],
              'email' => ['required', 'email'],
              'password' => ['required'],
              'type' => ['required', Rule::in(['Estudiante', 'Docente', 'Administrador'])],
              'phone' => ['required'],
              'dui' => ['required'],
              'carnet' => ['required'],
              'birthDate' => ['required'],
          ];
      } else {
          return[
              'name' => ['sometimes', 'required'],
              'lastname' => ['sometimes', 'required'],
              'email' => ['sometimes', 'required', 'email'],
              'password' => ['sometimes', 'required'],
              'type' => ['sometimes', 'required', Rule::in(['Estudiante', 'Docente', 'Administrador'])],
              'phone' => ['sometimes', 'required'],
              'dui' => ['sometimes', 'required'],
              'carnet' => ['sometimes', 'required'],
              'birthDate' => ['sometimes', 'required'],
          ];
      }
    }
    protected function prepareForValidation()
    {
        if ($this->birthDate){
            $this->merge([
                'birth_date' => $this->birthDate
            ]);
        }
    }
}
