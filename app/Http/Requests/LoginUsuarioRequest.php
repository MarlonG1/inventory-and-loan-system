<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginUsuarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public  function rules() : array
    {
        return [
          'password' => 'required',
            'email' => 'required'
        ];
    }

    public function messages() : array
    {
        return [
            'password.required' => 'La contraseña es un campo obligatorio',
            'email.required' => 'El correo electronico es un campo obligatorio'
        ];
    }
}
