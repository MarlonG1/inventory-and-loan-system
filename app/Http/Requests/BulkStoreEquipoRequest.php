<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BulkStoreEquipoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        return $user != null && $user->tokenCan('delete');

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            '*.marca' => ['required', 'string'],
            '*.modelo' => ['required', 'string'],
            '*.identificador' => ['required', 'string'],
            '*.estado' => ['required', Rule::in(['Disponible', 'En reparación', 'Ocupado'])],
            '*.observaciones' => ['nullable', 'string'],
        ];
    }

    protected function prepareForValidation()
    {
        $data = [];
        foreach ($this->toArray() as $obj) {
            $obj['prestamo_id'] = $obj['prestamoId'] ?? null;
            $data[] = $obj;
        }

        $this->merge($data);
    }

}
