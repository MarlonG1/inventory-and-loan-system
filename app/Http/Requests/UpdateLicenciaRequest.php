<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateLicenciaRequest extends FormRequest
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
                'nombre' => ['required'],
                'tipo' => ['required'],
                'clave' => ['required'],
                'estado' => ['required', Rule::in(['Activa', 'Por renovar', 'Inactiva', 'Vencida'])],
                'unidad' => ['required'],
                'observaciones' => ['required'],
                'fechaAdquisicion' => ['required'],
                'fechaVencimiento' => ['required'],
            ];
        } else {
            return [
                'nombre' => ['sometimes', 'required'],
                'tipo' => ['sometimes', 'required'],
                'clave' => ['sometimes', 'required'],
                'estado' => ['sometimes', 'required', Rule::in(['Activa', 'Por renovar', 'Inactiva', 'Vencida'])],
                'unidad' => ['sometimes', 'required'],
                'observaciones' => ['sometimes', 'required'],
                'fechaAdquisicion' => ['sometimes', 'required'],
                'fechaVencimiento' => ['sometimes', 'required'],
            ];
        }
    }

    protected function prepareForValidation()
    {
        $camposRequest = ['fechaAdquisicion', 'fechaVencimiento'];
        $camposBD = ['fecha_adquisicion', 'fecha_vencimiento'];

        foreach ($camposRequest as $key => $value) {
            if ($this->$value) {
                $this->merge([
                    $camposBD[$key] => $this->$value
                ]);
            }
        }
    }
}
