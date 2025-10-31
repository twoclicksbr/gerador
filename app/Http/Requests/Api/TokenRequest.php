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
            'environment'   => 'required|in:production,sandbox',
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

            'environment.required'   => 'O ambiente é obrigatório.',
            'environment.in'         => 'O ambiente deve ser production ou sandbox.',

            'token.required'         => 'O token é obrigatório.',
            'token.string'           => 'O token deve ser um texto válido.',
            'token.max'              => 'O token não pode ter mais que 255 caracteres.',
            'token.unique'           => 'Este token já está em uso.',

            'ip_address.max'         => 'O IP não pode ter mais que 191 caracteres.',

            'device_info.max'        => 'As informações do dispositivo não podem ter mais que 191 caracteres.',

            'active.boolean'         => 'O campo ativo deve ser verdadeiro ou falso.',
        ];
    }
}
