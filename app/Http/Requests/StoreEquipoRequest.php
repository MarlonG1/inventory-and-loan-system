<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEquipoRequest extends FormRequest
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
            'prestamoId' => ['nullable'],
            'marca' => ['required'],
            'modelo' => ['required'],
            'identificador' => ['required'],
            'estado' => ['required', Rule::in(['Disponible', 'En reparación', 'Ocupado'])],
            'observaciones' => ['required'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'prestamo_id' => $this->prestamoId,
        ]);
    }
}
