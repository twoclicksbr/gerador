<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class PlanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_credential'  => 'required|exists:tc_credential,id',
            'name'           => 'required|string|max:191',
            'price_monthly'  => 'required|numeric|min:0',
            'price_yearly'   => 'required|numeric|min:0',
            'active'         => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'id_credential.required' => 'A credencial é obrigatória.',
            'id_credential.exists'   => 'A credencial informada não existe.',

            'name.required'          => 'O nome do plano é obrigatório.',
            'name.string'            => 'O nome do plano deve ser um texto.',
            'name.max'               => 'O nome do plano não pode ter mais que 191 caracteres.',

            'price_monthly.required' => 'O preço mensal é obrigatório.',
            'price_monthly.numeric'  => 'O preço mensal deve ser numérico.',
            'price_monthly.min'      => 'O preço mensal deve ser maior ou igual a zero.',

            'price_yearly.required'  => 'O preço anual é obrigatório.',
            'price_yearly.numeric'   => 'O preço anual deve ser numérico.',
            'price_yearly.min'       => 'O preço anual deve ser maior ou igual a zero.',

            'active.boolean'         => 'O campo ativo deve ser verdadeiro ou falso.',
        ];
    }
}
