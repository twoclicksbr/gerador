<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'cep' => $this->cep ? preg_replace('/\D/', '', $this->cep) : null,
            'state' => strtoupper($this->state ?? ''),
        ]);
    }

    public function rules(): array
    {
        return [
            'id_credential'   => 'required|integer|exists:tc_credential,id',
            'id_person'       => 'required|integer|exists:tc_person,id',
            'id_type_address' => 'required|integer|exists:tc_type_address,id',
            'main'            => 'boolean',
            'cep'             => 'nullable|string|min:8|max:9',
            'street'          => 'nullable|string|max:255',
            'number'          => 'nullable|string|max:20',
            'complement'      => 'nullable|string|max:255',
            'district'        => 'nullable|string|max:255',
            'city'            => 'nullable|string|max:255',
            'state'           => 'nullable|string|size:2',
        ];
    }

    public function messages(): array
    {
        return [
            'id_credential.required'   => 'A credencial é obrigatória.',
            'id_person.required'       => 'A pessoa é obrigatória.',
            'id_type_address.required' => 'O tipo de endereço é obrigatório.',
            'state.size'               => 'O estado deve conter exatamente 2 letras.',
        ];
    }
}
