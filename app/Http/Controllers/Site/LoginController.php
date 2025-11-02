<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Api\PersonUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $user = PersonUser::where('email', $request->email)
            ->where('active', 1)
            ->whereNull('deleted_at')
            ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'E-mail ou senha inválidos.']);
        }

        $user->load(['person', 'person.credential']);

        // busca o plano + ciclo de pagamento
        $plan = DB::table('tc_person_plan')
            ->join('tc_plan', 'tc_plan.id', '=', 'tc_person_plan.id_plan')
            ->select('tc_plan.id', 'tc_plan.name', 'tc_person_plan.payment_cycle')
            ->where('tc_person_plan.id_person', $user->person->id)
            ->whereNull('tc_person_plan.deleted_at')
            ->orderByDesc('tc_person_plan.id')
            ->first();

        // converte o ciclo para português
        $cycle = match ($plan->payment_cycle ?? null) {
            'monthly' => 'Mensal',
            'yearly'  => 'Anual',
            'weekly'  => 'Semanal',
            'lifetime' => 'Vitalício',
            default   => 'Mensal',
        };

        session([
            'auth_user' => [
                'id'    => $user->id,
                'email' => $user->email,
            ],
            'auth_person' => [
                'id'   => $user->person->id,
                'name' => $user->person->name,
            ],
            'auth_credential' => [
                'id'   => $user->person->credential->id,
                'name' => $user->person->credential->name,
                'slug' => $user->person->credential->slug,
                'plan' => [
                    'id'             => $plan->id   ?? null,
                    'name'           => $plan->name ?? null,
                    'payment_cycle'  => $cycle,
                ],
            ],
        ]);

        // redireciona conforme a credencial
        if ($user->person->credential->id == 1) {
            return redirect()->route('admin.overview');
        }

        return redirect()->route('panel.overview');
    }

    public function logout()
    {
        session()->forget(['auth_user', 'auth_person', 'token']);
        return redirect()->route('login');
    }
}
