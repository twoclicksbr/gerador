<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class TypeAddressRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_credential' => 'nullable|exists:tc_credential,id',
            'name'          => 'required|string|max:100',
            'active'        => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'id_credential.exists' => 'A credencial informada não existe.',

            'name.required' => 'O nome do tipo de endereço é obrigatório.',
            'name.string'   => 'O nome do tipo de endereço deve ser um texto.',
            'name.max'      => 'O nome do tipo de endereço não pode ter mais que 100 caracteres.',

            'active.boolean' => 'O campo ativo deve ser verdadeiro ou falso.',
        ];
    }
}
