<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Api\Address;
use App\Models\Api\Credential;
use App\Models\Api\Person;
use App\Models\Api\PersonPlan;
use App\Models\Api\PersonUser;
use App\Models\Api\Plan;
use App\Models\Api\TypeAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Termwind\Components\Dd;
use Throwable;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function index(Request $request)
    {
        $plans = Plan::where('active', 1)
            ->orderBy('price_monthly')
            ->get();

        $typeAddresses = TypeAddress::where('active', 1)
            ->orderBy('name')
            ->get(['id', 'name']);

        $selectedPlan = $request->get('plans');
        $selectedPeriod = $request->get('period', 'month');

        return view('register', compact('plans', 'typeAddresses', 'selectedPlan', 'selectedPeriod'));
    }

    public function store(Request $request)
    {
        Log::info('🟢 [RegisterController@store] Início do cadastro', ['payload' => $request->all()]);

        try {
            DB::beginTransaction();

            // ============================================================
            // Normalização
            // ============================================================
            $cpfCnpj  = preg_replace('/\D/', '', $request->cpf_cnpj);
            $whatsapp = ($request->country_code ?? '+55') . preg_replace('/\D/', '', $request->whatsapp_number);

            Log::info('📋 Campos normalizados', [
                'cpf_cnpj'  => $cpfCnpj,
                'whatsapp'  => $whatsapp,
                'plan'      => $request->selected_plan,
                'period'    => $request->selected_period,
            ]);

            // ============================================================
            // Criação da credencial (usando o nome da pessoa)
            // ============================================================
            $credential = Credential::create([
                'name'            => $request->name,
                'slug'            => Str::slug($request->name, '-'),
                'active'          => 1,
                'dt_limit_access' => now()->addDays(7), // 🔹 período de teste inicial
            ]);

            Log::info('🏷️ Credencial criada', [
                'credential_id' => $credential->id,
                'name'          => $credential->name,
                'slug'          => $credential->slug,
            ]);

            // ============================================================
            // Criação da pessoa
            // ============================================================
            $person = Person::create([
                'id_credential' => $credential->id,
                'name'          => $request->name,
                'gender'        => $request->gender,
                'birthdate'     => $request->birthdate,
                'whatsapp'      => $whatsapp,
                'cpf_cnpj'      => $cpfCnpj,
                'active'        => 1,
            ]);

            Log::info('👤 Pessoa criada', [
                'person_id' => $person->id,
                'name' => $person->name
            ]);

            // ============================================================
            // Criação do usuário vinculado
            // ============================================================
            $user = PersonUser::create([
                'id_person'     => $person->id,
                'id_credential' => $credential->id,
                'email'         => $request->email,
                'password'      => bcrypt($request->password),
                'active'        => 1,
            ]);

            Log::info('🔐 Usuário criado', [
                'user_id' => $user->id,
                'email' => $user->email
            ]);

            // ============================================================
            // Criação do endereço
            // ============================================================
            $address = Address::create([
                'id_credential'   => $credential->id,
                'id_person'       => $person->id,
                'id_type_address' => $request->id_type_address,
                'main'            => true,
                'cep'             => preg_replace('/\D/', '', $request->zip_code),
                'street'          => $request->street,
                'number'          => $request->number,
                'complement'      => $request->complement,
                'district'        => $request->district,
                'city'            => $request->city,
                'state'           => strtoupper($request->state),
            ]);

            Log::info('🏠 Endereço criado', [
                'address_id' => $address->id
            ]);

            // ============================================================
            // Vínculo com plano
            // ============================================================
            $plan = Plan::whereRaw('LOWER(name) = ?', [strtolower($request->selected_plan)])
                ->where('active', 1)
                ->first();

            if ($plan) {
                $personPlan = PersonPlan::create([
                    'id_credential' => $credential->id,
                    'id_person'     => $person->id,
                    'id_plan'       => $plan->id,
                    'period'        => $request->selected_period,
                    'active'        => 1,
                ]);
                Log::info('💳 Plano vinculado', [
                    'plan_id' => $plan->id,
                    'person_plan_id' => $personPlan->id,
                    'plan_name' => $plan->name,
                ]);
            } else {
                Log::warning('⚠️ Nenhum plano ativo encontrado', [
                    'selected_plan' => $request->selected_plan,
                ]);
            }

            DB::commit();
            Log::info('✅ [RegisterController@store] Cadastro concluído com sucesso', [
                'person_id' => $person->id,
                'user_id'   => $user->id,
            ]);

            return redirect()->route('login')->with('success', 'Cadastro realizado com sucesso!');
        } catch (Throwable $e) {
            DB::rollBack();

            Log::error('❌ [RegisterController@store] Erro no cadastro', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'trace'   => $e->getTraceAsString(),
            ]);

            return back()
                ->withErrors(['error' => 'Erro ao criar conta: ' . $e->getMessage()])
                ->withInput();
        }
    }




















    // =================================================
    // Verificação do campo e-mail
    // =================================================
    public function checkEmail(Request $request)
    {
        $exists = PersonUser::where('email', $request->email)
            ->whereNull('deleted_at')
            ->exists();

        return response()->json(['exists' => $exists]);
    }

    // =================================================
    // Verificação do campo cpf_cnpj
    // =================================================
    public function checkCpfCnpj(Request $request)
    {
        $cpfCnpj = preg_replace('/\D/', '', $request->cpf_cnpj);

        $exists = Person::where('cpf_cnpj', $cpfCnpj)
            ->whereNull('deleted_at')
            ->exists();

        return response()->json(['exists' => $exists]);
    }
}
