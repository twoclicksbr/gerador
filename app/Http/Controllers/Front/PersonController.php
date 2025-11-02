<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PersonRequest;
use App\Models\Api\Address;
use App\Models\Api\Credential;
use App\Models\Api\Person;
use App\Models\Api\TypeAddress;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class PersonController extends Controller
{
    public function index(Request $request, $module)
    {
        $count = Person::count();

        $items = Person::withTrashed()
            ->orderBy('name')
            ->get();

        return view("admin.$module.index", compact('module', 'count', 'items'));
    }

    public function create(Request $request, $module)
    {
        $credentials = Credential::orderBy('name')->get();
        $typeAddresses = TypeAddress::orderBy('name')->get();

        return view("admin.$module.create", compact('module', 'credentials', 'typeAddresses'));
    }

    public function store(PersonRequest $request, $module)
    {
        Log::info('🟢 [PersonController@store] Início do cadastro', ['payload' => $request->validated()]);

        try {
            DB::beginTransaction();

            $validated = $request->validated();

            $person = Person::create([
                'id_credential' => $validated['id_credential'],
                'name'          => $validated['name'],
                'gender'        => $validated['gender'] ?? null,
                'birthdate'     => $validated['birthdate'] ?? null,
                'whatsapp'      => $validated['whatsapp'],
                'cpf_cnpj'      => $validated['cpf_cnpj'],
                'active'        => $request->has('active') ? 1 : 0,
            ]);

            Log::info('👤 Pessoa criada', [
                'person_id' => $person->id,
                'name'      => $person->name,
            ]);

            // ============================================================
            // Criação do endereço (se houver)
            // ============================================================
            if ($request->filled('zip_code')) {
                $address = Address::create([
                    'id_credential'   => $validated['id_credential'],
                    'id_person'       => $person->id,
                    'id_type_address' => $request->id_type_address ?? null,
                    'main'            => true,
                    'cep'             => $request->zip_code,
                    'street'          => $request->street,
                    'number'          => $request->number,
                    'complement'      => $request->complement,
                    'district'        => $request->district,
                    'city'            => $request->city,
                    'state'           => strtoupper($request->state ?? ''),
                ]);

                Log::info('🏠 Endereço criado', ['address_id' => $address->id]);
            }

            DB::commit();
            Log::info('✅ [PersonController@store] Cadastro concluído com sucesso');

            return redirect()
                ->route('admin.module.index', ['module' => $module])
                ->with('success', 'Registro criado com sucesso!');
        } catch (Throwable $e) {
            DB::rollBack();

            Log::error('❌ [PersonController@store] Erro no cadastro', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
            ]);

            return back()->withErrors(['error' => 'Erro ao criar registro: ' . $e->getMessage()]);
        }
    }

    public function edit(Request $request, $module, $id)
    {
        $item = Person::withTrashed()
            ->with(['address' => fn($q) => $q->where('main', 1)])
            ->findOrFail($id);

        $isTrashed = $item->trashed();
        $credentials = Credential::orderBy('name')->get();
        $typeAddresses = TypeAddress::orderBy('name')->get();

        return view("admin.$module.edit", compact('item', 'module', 'isTrashed', 'credentials', 'typeAddresses'));
    }

    public function update(PersonRequest $request, $module, $id)
    {
        Log::info('🟡 [PersonController@update] Atualização iniciada', ['id' => $id]);

        try {
            DB::beginTransaction();

            $validated = $request->validated();

            $person = Person::findOrFail($id);
            $person->update([
                'name'      => $validated['name'],
                'gender'    => $validated['gender'] ?? null,
                'birthdate' => $validated['birthdate'] ?? null,
                'cpf_cnpj'  => $validated['cpf_cnpj'],
                'whatsapp'  => $validated['whatsapp'],
                'active'    => $request->has('active') ? 1 : 0,
            ]);

            Log::info('👤 Pessoa atualizada', ['person_id' => $id]);

            // ============================================================
            // Atualização de endereço (se houver)
            // ============================================================
            if ($request->filled('zip_code')) {
                $address = Address::where('id_person', $id)->where('main', 1)->first();

                $addressData = [
                    'id_type_address' => $request->id_type_address ?? null,
                    'cep'             => $request->zip_code,
                    'street'          => $request->street,
                    'number'          => $request->number,
                    'complement'      => $request->complement,
                    'district'        => $request->district,
                    'city'            => $request->city,
                    'state'           => strtoupper($request->state ?? ''),
                ];

                if ($address) {
                    $address->update($addressData);
                } else {
                    Address::create([
                        'id_credential'   => $person->id_credential,
                        'id_person'       => $id,
                        ...$addressData,
                        'main'            => true,
                    ]);
                }

                Log::info('🏠 Endereço atualizado/criado', ['person_id' => $id]);
            }

            DB::commit();
            Log::info('✅ [PersonController@update] Registro atualizado com sucesso');

            return redirect()
                ->route('admin.module.index', ['module' => $module])
                ->with('success', 'Registro atualizado com sucesso!');
        } catch (Throwable $e) {
            DB::rollBack();

            Log::error('❌ [PersonController@update] Erro ao atualizar', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
            ]);

            return back()->withErrors(['error' => 'Erro ao atualizar registro: ' . $e->getMessage()]);
        }
    }

    public function destroy(Request $request, $module, $id)
    {
        try {
            $record = Person::findOrFail($id);
            Log::info('🗑️ Pessoa deletada', ['person_id' => $id, 'name' => $record->name]);
            $record->delete();

            return redirect()->route('admin.module.index', ['module' => $module])
                ->with('success', 'Registro deletado com sucesso!');
        } catch (Throwable $e) {
            Log::error('❌ Erro ao deletar pessoa', [
                'person_id' => $id,
                'message' => $e->getMessage(),
            ]);
            return back()->withErrors(['error' => 'Erro ao deletar registro']);
        }
    }

    public function restore(Request $request, $module, $id)
    {
        try {
            $record = Person::withTrashed()->findOrFail($id);
            Log::info('♻️ Pessoa restaurada', ['person_id' => $id, 'name' => $record->name]);
            $record->restore();

            return redirect()->route('admin.module.index', ['module' => $module])
                ->with('success', 'Registro restaurado com sucesso!');
        } catch (Throwable $e) {
            Log::error('❌ Erro ao restaurar pessoa', [
                'person_id' => $id,
                'message' => $e->getMessage(),
            ]);
            return back()->withErrors(['error' => 'Erro ao restaurar registro']);
        }
    }
}
