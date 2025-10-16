<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class PersonRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_credential' => 'required|exists:tc_credential,id',
            'name'          => 'required|string|max:191',
            'birthdate'     => 'nullable|date',
            'active'        => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'id_credential.required' => 'A credencial é obrigatória.',
            'id_credential.exists'   => 'A credencial informada não existe.',

            'name.required'          => 'O nome é obrigatório.',
            'name.string'            => 'O nome deve ser um texto.',
            'name.max'               => 'O nome não pode ter mais que 191 caracteres.',

            'birthdate.date'         => 'A data de nascimento deve ser válida.',

            'active.boolean'         => 'O campo ativo deve ser verdadeiro ou falso.',
        ];
    }
}
