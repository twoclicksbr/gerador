<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class PersonUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_credential'   => 'required|exists:tc_credential,id',
            'id_person'       => 'required|exists:tc_person,id',
            'email'           => 'required|email|max:191|unique:tc_person_user,email,' . $this->id,
            'password'        => $this->isMethod('post') ? 'required|string|min:6' : 'nullable|string|min:6',
            'remember_token'  => 'boolean',
            'active'          => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'id_credential.required'   => 'A credencial é obrigatória.',
            'id_credential.exists'     => 'A credencial informada não existe.',

            'id_person.required'       => 'A pessoa é obrigatória.',
            'id_person.exists'         => 'A pessoa informada não existe.',

            'email.required'           => 'O e-mail é obrigatório.',
            'email.email'              => 'Informe um e-mail válido.',
            'email.unique'             => 'Este e-mail já está em uso.',

            'password.required'        => 'A senha é obrigatória.',
            'password.min'             => 'A senha deve ter pelo menos 6 caracteres.',

            'remember_token.boolean'   => 'O campo remember_token deve ser verdadeiro ou falso.',

            'active.boolean'           => 'O campo ativo deve ser verdadeiro ou falso.',
        ];
    }
}
