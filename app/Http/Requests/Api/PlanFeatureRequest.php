<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class PlanFeatureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_credential' => 'required|exists:tc_credential,id',
            'id_plan'       => 'required|exists:tc_plan,id',
            'name'          => 'required|string|max:191',
            'description'   => 'nullable|string|max:191',
            'value'         => 'nullable|string|max:191',
            'active'        => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'id_credential.required' => 'A credencial é obrigatória.',
            'id_credential.exists'   => 'A credencial informada não existe.',

            'id_plan.required'       => 'O plano é obrigatório.',
            'id_plan.exists'         => 'O plano informado não existe.',

            'name.required'          => 'O nome da característica é obrigatório.',
            'name.string'            => 'O nome deve ser um texto.',
            'name.max'               => 'O nome não pode ter mais que 191 caracteres.',

            'description.string'     => 'A descrição deve ser um texto.',
            'description.max'        => 'A descrição não pode ter mais que 191 caracteres.',

            'value.string'           => 'O valor deve ser um texto.',
            'value.max'              => 'O valor não pode ter mais que 191 caracteres.',

            'active.boolean'         => 'O campo ativo deve ser verdadeiro ou falso.',
        ];
    }
}
