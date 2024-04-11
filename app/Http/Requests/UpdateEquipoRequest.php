<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEquipoRequest extends FormRequest
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
                'prestamoId' => ['nullable'],
                'marca' => ['required'],
                'modelo' => ['required'],
                'identificador' => ['required'],
                'estado' => ['required', Rule::in(['Disponible', 'En reparación', 'Ocupado'])],
                'unidad' => ['required'],
                'observaciones' => ['required'],
            ];
        } else {
            return [
                'prestamoId' => ['sometimes', 'nullable'],
                'marca' => ['sometimes', 'required'],
                'modelo' => ['sometimes', 'required'],
                'identificador' => ['sometimes', 'required'],
                'estado' => ['sometimes', 'required', Rule::in(['Disponible', 'En reparación', 'Ocupado'])],
                'unidad' => ['sometimes', 'required'],
                'observaciones' => ['sometimes', 'required'],
            ];
        }
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'prestamo_id' => $this->prestamoId
        ]);

    }
}
