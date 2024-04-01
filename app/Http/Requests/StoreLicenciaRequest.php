<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLicenciaRequest extends FormRequest
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
            'tipo' => ['required'],
            'clave' => ['required'],
            'estado' => ['required',  Rule::in(['Activa', 'Por renovar', 'Inactiva', 'Vencida'])],
            'unidad' => ['required'],
            'observaciones' => ['required'],
            'fechaAdquisicion' => ['required'],
            'fechaVencimiento' => ['required'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'fecha_adquisicion' => $this->fechaAdquisicion,
            'fecha_vencimiento' => $this->fechaVencimiento,
        ]);
    }
}
