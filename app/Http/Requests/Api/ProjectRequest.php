<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'slug'          => 'required|string|max:191|unique:tc_project,slug,' . $this->id . ',id,id_credential,' . $this->id_credential,
            'active'        => 'boolean',
            'description'   => 'nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'id_credential.required' => 'A credencial é obrigatória.',
            'id_credential.exists'   => 'A credencial informada não existe.',

            'name.required'          => 'O nome do projeto é obrigatório.',
            'name.string'            => 'O nome deve ser um texto válido.',
            'name.max'               => 'O nome não pode ter mais que 191 caracteres.',

            'slug.required'          => 'O slug é obrigatório.',
            'slug.string'            => 'O slug deve ser um texto válido.',
            'slug.max'               => 'O slug não pode ter mais que 191 caracteres.',
            'slug.unique'            => 'Já existe um projeto com esse slug nessa credencial.',

            'description.max'        => 'A descrição não pode ter mais que 500 caracteres.',

            'active.boolean'         => 'O campo ativo deve ser verdadeiro ou falso.',
        ];
    }
}
