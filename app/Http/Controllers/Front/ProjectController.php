<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProjectRequest;
use App\Models\Api\Project;
use App\Models\Api\Credential;
use App\Models\Api\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index(Request $request, $module)
    {
        $count = Project::count();

        $items = Project::withTrashed()
            ->join('tc_credential', 'tc_credential.id', '=', 'tc_project.id_credential')
            ->orderBy('tc_credential.name', 'asc')
            ->orderBy('tc_project.name', 'asc')
            ->select('tc_project.*', 'tc_credential.name as credential_name')
            ->get();

        return view("admin.$module.index", compact('module', 'count', 'items'));
    }

    public function create(Request $request, $module)
    {
        $credentials = Credential::orderBy('name')->get();

        return view("admin.$module.create", compact('module', 'credentials'));
    }

    public function store(Request $request, $module)
    {
        // ✅ valida com ProjectRequest
        $validated = $request->validate((new ProjectRequest)->rules());
        $validated['active'] = $request->input('active', 0);

        // ✅ cria o projeto
        $project = Project::create($validated);

        // ✅ cria tokens automaticamente (production e sandbox)
        $prefixes = [
            'production' => 'secret_',
            'sandbox'    => 'public_',
        ];

        foreach ($prefixes as $env => $prefix) {
            Token::create([
                'id_credential' => $project->id_credential,
                'id_project'    => $project->id,
                'token'         => $prefix . Str::random(60),
                'environment'   => $env,
                'ip_address'    => $request->ip(),
                'device_info'   => $request->header('User-Agent'),
                'active'        => 1,
            ]);
        }

        return redirect()
            ->route('admin.module.index', ['module' => $module])
            ->with('success', 'Projeto criado com sucesso e tokens gerados!');
    }

    public function edit(Request $request, $module, $id)
    {
        $item = Project::withTrashed()->findOrFail($id);
        $isTrashed = $item->trashed();

        $credentials = Credential::orderBy('name')->get();

        return view("admin.$module.edit", compact('item', 'module', 'isTrashed', 'credentials'));
    }

    public function update(Request $request, $module, $id)
    {
        $validated = $request->validate([
            'id_credential' => 'required|exists:tc_credential,id',
            'name'          => 'required|string|max:255',
            'slug'          => 'required|string|max:255|unique:tc_project,slug,' . $id,
            'description'   => 'nullable|string',
            'active'        => 'boolean',
        ]);

        $validated['active'] = $request->input('active', 0);

        $record = Project::findOrFail($id);
        $record->update($validated);

        return redirect()
            ->route('admin.module.index', ['module' => $module])
            ->with('success', 'Projeto atualizado com sucesso!');
    }

    public function destroy(Request $request, $module, $id)
    {
        Project::findOrFail($id)->delete();

        return redirect()
            ->route('admin.module.index', ['module' => $module]);
    }

    public function restore(Request $request, $module, $id)
    {
        Project::withTrashed()->findOrFail($id)->restore();

        return redirect()
            ->route('admin.module.index', ['module' => $module]);
    }
}
