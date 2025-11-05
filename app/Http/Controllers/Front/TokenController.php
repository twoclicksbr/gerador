<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TokenRequest;
use App\Models\Api\Token;
use App\Models\Api\Credential;
use App\Models\Api\Project;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function index(Request $request, $module)
    {
        $count = Token::count();

        $items = Token::withTrashed()
            ->join('tc_credential', 'tc_credential.id', '=', 'tc_token.id_credential')
            ->leftJoin('tc_project', 'tc_project.id', '=', 'tc_token.id_project')
            ->orderBy('tc_credential.name', 'asc')   // Credencial
            ->orderBy('tc_project.name', 'asc')      // Projeto
            ->orderBy('tc_token.environment', 'desc') // Ambiente
            ->select('tc_token.*', 'tc_project.name as project_name', 'tc_credential.name as credential_name')
            ->get();

        return view("admin.$module.index", compact('module', 'count', 'items'));
    }

    public function create(Request $request, $module)
    {
        $credentials = Credential::orderBy('name')->get();
        $projects = Project::orderBy('name')->get();

        return view("admin.$module.create", compact('module', 'credentials', 'projects'));
    }

    public function store(TokenRequest $request, $module)
    {
        $validated = $request->validated();
        $validated['active'] = $request->has('active') ? 1 : 0;

        Token::create($validated);

        return redirect()
            ->route('admin.module.index', ['module' => $module])
            ->with('success', 'Token criado com sucesso!');
    }

    public function edit(Request $request, $module, $id)
    {
        $item = Token::withTrashed()->findOrFail($id);
        $isTrashed = $item->trashed();

        $credentials = Credential::orderBy('name')->get();
        $projects = Project::orderBy('name')->get();

        return view("admin.$module.edit", compact('item', 'module', 'isTrashed', 'credentials', 'projects'));
    }

    public function update(Request $request, $module, $id)
    {
        // ✅ aplica as regras do TokenRequest manualmente
        $rules = (new \App\Http\Requests\Api\TokenRequest)->rules();
        $rules['token'] = 'required|string|max:255|unique:tc_token,token,' . $id;

        $validated = $request->validate($rules);

        $validated['active'] = $request->input('active', 0);

        $record = \App\Models\Api\Token::findOrFail($id);
        $record->update($validated);

        return redirect()
            ->route('admin.module.index', ['module' => $module])
            ->with('success', 'Token atualizado com sucesso!');
    }

    public function destroy(Request $request, $module, $id)
    {
        Token::findOrFail($id)->delete();

        return redirect()
            ->route('admin.module.index', ['module' => $module]);
    }

    public function restore(Request $request, $module, $id)
    {
        Token::withTrashed()->findOrFail($id)->restore();

        return redirect()
            ->route('admin.module.index', ['module' => $module]);
    }
}
