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
        //Manejo de autenticacion en API
//        $user = $this->user();
//        return $user != null && $user->tokenCan('delete');
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
            '*.prestamoId' => ['required', 'integer'],
            '*.marca' => ['required', 'string'],
            '*.modelo' => ['required', 'string'],
            '*.identificador' => ['required', 'string'],
            '*.estado' => ['required', Rule::in(['Disponible', 'En reparación', 'Ocupado'])],
            '*.unidad' => ['required', 'integer'],
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
