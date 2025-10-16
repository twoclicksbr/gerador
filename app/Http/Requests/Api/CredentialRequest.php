<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CredentialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'            => 'required|string|max:191',
            'slug'            => 'required|string|max:191|unique:tc_credential,slug,' . $this->id,
            'dt_limit_access' => 'nullable|date',
            'active'          => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório.',

            'slug.required' => 'O identificador (slug) é obrigatório.',
            'slug.unique'   => 'Este slug já está em uso.',
            'slug.max'      => 'O slug não pode ter mais que 191 caracteres.',

            'dt_limit_access.date' => 'A data limite de acesso deve ser uma data válida.',

            'active.boolean' => 'O campo ativo deve ser verdadeiro ou falso.',
        ];
    }
}
