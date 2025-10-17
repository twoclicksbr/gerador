<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class TokenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_credential' => 'required|exists:tc_credential,id',
            'id_person'     => 'required|exists:tc_person,id',
            'token'         => 'required|string|max:255|unique:tc_token,token,' . $this->id,
            'ip_address'    => 'nullable|string|max:191',
            'device_info'   => 'nullable|string|max:191',
            'active'        => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'id_credential.required' => 'A credencial é obrigatória.',
            'id_credential.exists'   => 'A credencial informada não existe.',

            'id_person.required'     => 'A pessoa é obrigatória.',
            'id_person.exists'       => 'A pessoa informada não existe.',

            'token.required'         => 'O token é obrigatório.',
            'token.unique'           => 'Este token já está em uso.',

            'ip_address.max'         => 'O IP não pode ter mais que 191 caracteres.',

            'device_info.max'        => 'As informações do dispositivo não podem ter mais que 191 caracteres.',

            'active.boolean'         => 'O campo ativo deve ser verdadeiro ou falso.',
        ];
    }
}
