<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Api\TypeAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TypeAddressController extends Controller
{
    public function index(Request $request, $module)
    {
        $count = TypeAddress::count();

        $items = TypeAddress::withTrashed()
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
        $validated = $request->validate([
            'name'   => 'required|string|max:100',
            'active' => 'boolean',
        ]);

        $validated['id_credential'] = 1;
        $validated['active'] = $request->input('active', 0);

        TypeAddress::create($validated);

        return redirect()
            ->route('admin.module.index', ['module' => $module])
            ->with('success', 'Registro criado com sucesso!');
    }

    public function edit(Request $request, $module, $id)
    {
        $item = TypeAddress::withTrashed()->findOrFail($id);
        $isTrashed = $item->trashed();

        return view("admin.$module.edit", compact('item', 'module', 'isTrashed'));
    }

    public function update(Request $request, $module, $id)
    {
        $data = $request->all();
        $data['active'] = $request->input('active', 0);

        $record = TypeAddress::findOrFail($id);
        $record->update($data);

        return redirect()
            ->route('admin.module.index', ['module' => $module])
            ->with('success', 'Registro atualizado com sucesso!');
    }

    public function destroy(Request $request, $module, $id)
    {
        $record = TypeAddress::findOrFail($id);
        $record->delete();

        return redirect()->route('admin.module.index', ['module' => $module]);
    }

    public function restore(Request $request, $module, $id)
    {
        $record = TypeAddress::withTrashed()->findOrFail($id);
        $record->restore();

        return redirect()->route('admin.module.index', ['module' => $module]);
    }
}
