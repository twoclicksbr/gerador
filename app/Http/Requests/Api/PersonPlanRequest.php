<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class PersonPlanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_credential'   => 'nullable|exists:tc_credential,id',
            'id_person'       => 'required|exists:tc_person,id',
            'id_plan'         => 'required|exists:tc_plan,id',
            'payment_cycle'   => 'nullable|in:mensal,anual',
            'dt_start'        => 'nullable|date',
            'dt_end'          => 'nullable|date|after_or_equal:dt_start',
            'active'          => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'id_credential.exists'  => 'A credencial informada não existe.',

            'id_person.required'    => 'A pessoa é obrigatória.',
            'id_person.exists'      => 'A pessoa informada não existe.',

            'id_plan.required'      => 'O plano é obrigatório.',
            'id_plan.exists'        => 'O plano informado não existe.',

            'payment_cycle.in'      => 'O ciclo de pagamento deve ser mensal ou anual.',

            'dt_start.date'         => 'A data inicial deve ser válida.',
            'dt_end.date'           => 'A data final deve ser válida.',
            'dt_end.after_or_equal' => 'A data final deve ser posterior ou igual à inicial.',

            'active.boolean'        => 'O campo ativo deve ser verdadeiro ou falso.',
        ];
    }
}
