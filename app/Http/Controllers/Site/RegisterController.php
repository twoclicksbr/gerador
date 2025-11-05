<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Api\Address;
use App\Models\Api\Credential;
use App\Models\Api\Person;
use App\Models\Api\PersonPlan;
use App\Models\Api\PersonUser;
use App\Models\Api\Plan;
use App\Models\Api\Token;
use App\Models\Api\TypeAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

use App\Mail\ConfirmEmail;
use App\Models\Api\EmailConfirmation;
use Illuminate\Support\Facades\Mail;

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
            // Criação da credencial
            // ============================================================
            $credential = Credential::create([
                'name'            => $request->credential_name,
                'slug'            => Str::random(24), // 🔒 identificador único
                'active'          => 1,
                'dt_limit_access' => now()->addDays(7),
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
                'name'      => $person->name,
            ]);

            // ============================================================
            // Criação do usuário
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
                'email'   => $user->email,
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

            Log::info('🏠 Endereço criado', ['address_id' => $address->id]);

            // ============================================================
            // Vínculo com plano
            // ============================================================
            $plan = Plan::whereRaw('LOWER(name) = ?', [strtolower($request->selected_plan)])
                ->where('active', 1)
                ->first();

            if ($plan) {
                $cycle = $request->selected_period === 'annual' ? 'annual' : 'month';
                $now   = now();

                $personPlan = PersonPlan::create([
                    'id_credential' => $credential->id,
                    'id_person'     => $person->id,
                    'id_plan'       => $plan->id,
                    'payment_cycle' => $cycle,
                    'dt_start'      => $now,
                    'dt_end'        => $cycle === 'annual'
                        ? $now->copy()->addYear()
                        : $now->copy()->addMonth(),
                    'active'        => 1,
                ]);

                Log::info('💳 Plano vinculado', [
                    'plan_id'        => $plan->id,
                    'person_plan_id' => $personPlan->id,
                    'plan_name'      => $plan->name,
                    'cycle'          => $cycle,
                    'dt_start'       => $now,
                    'dt_end'         => $personPlan->dt_end,
                ]);
            } else {
                Log::warning('⚠️ Nenhum plano ativo encontrado', [
                    'selected_plan' => $request->selected_plan,
                ]);
            }

            // ============================================================
            // Envio do e-mail de confirmação
            // ============================================================
            $verifyToken = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

            Mail::to($request->email)->send(new ConfirmEmail($user, $verifyToken));

            EmailConfirmation::updateOrCreate(
                ['email' => $request->email],
                [
                    'token'        => $verifyToken,
                    'confirmed'    => false,
                    'confirmed_at' => null,
                ]
            );

            Log::info('📧 E-mail de confirmação enviado', [
                'to'    => $request->email,
                'token' => $verifyToken,
            ]);

            DB::commit();

            Log::info('✅ [RegisterController@store] Cadastro concluído com sucesso', [
                'person_id' => $person->id,
                'user_id'   => $user->id,
            ]);

            session([
                'register_name' => $request->name,
                'register_email' => $request->email,
            ]);

            return redirect()->route('register.confirm');
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
        $email = $request->email;
        $personId = $request->query('person_id'); // Pega o person_id da URL

        // ✅ Se person_id for fornecido, ignora o e-mail do próprio usuário
        $query = PersonUser::where('email', $email)
            ->whereNull('deleted_at');

        if ($personId) {
            $query->where('id_person', '!=', $personId);
        }

        $exists = $query->exists();

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



    // =================================================
    // Exibe tela de Confirmação de E-mail
    // =================================================
    public function confirmEmail()
    {
        $name  = session('register_name');
        $email = session('register_email');

        if (!$name || !$email) {
            return redirect()->route('login')->with('error', 'Por favor, faça login para continuar.');
        }

        return view('confirm-email', compact('name', 'email'));
    }

    // =================================================
    // Confirmação do E-mail
    // =================================================
    public function verifyEmail(Request $request)
    {
        $email = $request->input('email');
        $token = collect(range(1, 6))
            ->map(fn($i) => $request->input("code_$i"))
            ->implode('');

        $record = EmailConfirmation::where('email', $email)
            ->where('token', $token)
            ->first();

        if (!$record) {
            return back()->withErrors(['token' => 'Código inválido ou expirado.']);
        }

        $record->update([
            'confirmed' => true,
            'confirmed_at' => now(),
        ]);

        // 🔹 Limpa a sessão usada no registro
        session()->forget(['register_name', 'register_email']);

        return redirect()->route('login')
            ->with('success', 'E-mail confirmado com sucesso!');
    }
}
