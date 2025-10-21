<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class PersonRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation(): void
    {
        // remove tudo que não for número
        $number = $this->whatsapp_number ? preg_replace('/\D/', '', $this->whatsapp_number) : null;
        $code   = $this->country_code ?? '+55';

        $this->merge([
            'cpf_cnpj'  => $this->cpf_cnpj ? preg_replace('/\D/', '', $this->cpf_cnpj) : null,
            'whatsapp'  => $code . $number,
        ]);
    }

    public function rules(): array
    {
        return [
            'id_credential' => 'required|exists:tc_credential,id',
            'name'          => 'required|string|max:191',
            'whatsapp'      => 'nullable|string|max:20',
            'cpf_cnpj'      => 'nullable|string|max:20',
            'gender'        => 'nullable|string|max:20',
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

            'whatsapp.string'        => 'O WhatsApp deve ser um texto.',
            'whatsapp.max'           => 'O WhatsApp não pode ter mais que 20 caracteres.',

            'cpf_cnpj.string'        => 'O CPF/CNPJ deve ser um texto.',
            'cpf_cnpj.max'           => 'O CPF/CNPJ não pode ter mais que 20 caracteres.',

            'gender.string'          => 'O gênero deve ser um texto.',
            'gender.max'             => 'O gênero não pode ter mais que 20 caracteres.',

            'birthdate.date'         => 'A data de nascimento deve ser válida.',

            'active.boolean'         => 'O campo ativo deve ser verdadeiro ou falso.',
        ];
    }
}
