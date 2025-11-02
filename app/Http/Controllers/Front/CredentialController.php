<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\Credential;

use Carbon\Carbon;
use Illuminate\Support\Str;

class CredentialController extends Controller
{
    public function index(Request $request, $module)
    {
        // Conta apenas os registros ativos (não deletados)
        $count = \App\Models\Api\Credential::count();

        // Busca todos, incluindo os excluídos
        $items = \App\Models\Api\Credential::withTrashed()
            ->orderBy('name')
            ->get();

        return view("admin.$module.index", compact('module', 'count', 'items'));
    }

    public function create(Request $request, $module)
    {
        return view("admin.$module.create", compact('module'));
    }

    public function store(Request $request, $module)
    {
        $data = $request->all();

        // Corrige formato da data
        if (!empty($data['dt_limit_access'])) {
            $data['dt_limit_access'] = Carbon::createFromFormat('d/m/Y', $data['dt_limit_access'])->format('Y-m-d');
        }

        // Corrige campo booleano
        $data['active'] = $request->has('active') ? 1 : 0;

        $modelClass = "App\\Models\\Api\\" . Str::studly($module);
        $record = $modelClass::create($data);

        return redirect()
            ->route('admin.module.index', ['module' => $module])
            ->with('success', 'Registro criado com sucesso!');
    }

    public function edit(Request $request, $module, $id)
    {
        $modelClass = "App\\Models\\Api\\" . Str::studly($module);
        $item = $modelClass::withTrashed()->findOrFail($id);
        $isTrashed = $item->trashed();

        return view("admin.$module.edit", compact('item', 'module', 'isTrashed'));
    }

    public function update(Request $request, $module, $id)
    {
        $data = $request->all();

        // Corrige formato da data
        if (!empty($data['dt_limit_access'])) {
            $data['dt_limit_access'] = Carbon::createFromFormat('d/m/Y', $data['dt_limit_access'])->format('Y-m-d');
        }

        // Corrige campo booleano
        $data['active'] = $request->has('active') ? 1 : 0;

        $modelClass = "App\\Models\\Api\\" . Str::studly($module);
        $record = $modelClass::findOrFail($id);
        $record->update($data);

        return redirect()
            ->route('admin.module.index', ['module' => $module])
            ->with('success', 'Registro atualizado com sucesso!');
    }

    public function destroy(Request $request, $module, $id)
    {
        $record = Credential::findOrFail($id);
        $record->delete();
        return redirect()->route('admin.module.index', ['module' => $module]);
    }

    public function restore(Request $request, $module, $id)
    {
        $record = Credential::withTrashed()->findOrFail($id);
        $record->restore();
        return redirect()->route('admin.module.index', ['module' => $module]);
    }
}
