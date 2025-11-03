<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Api\Token;
use Illuminate\Http\Request;
use App\Models\Api\Credential;

class TokenController extends Controller
{
    public function index(Request $request, $module)
    {
        $count = Token::count();
        $items = Token::withTrashed()
            ->orderBy('environment', 'desc')
            ->get();

        return view("admin.$module.index", compact('module', 'count', 'items'));
    }

    public function create(Request $request, $module)
    {
        $credentials = \App\Models\Api\Credential::orderBy('name')->get();
        return view("admin.$module.create", compact('module', 'credentials'));
    }

    public function store(Request $request, $module)
    {
        $validated = $request->validate([
            'id_credential' => 'required|exists:tc_credential,id',
            'environment'   => 'required|in:production,sandbox',
            'token'         => 'required|string|unique:tc_token,token',
            'ip_address'    => 'nullable|string|max:100',
            'device_info'   => 'nullable|string|max:255',
            'active'        => 'boolean',
        ]);

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

        return view("admin.$module.edit", compact('item', 'module', 'isTrashed', 'credentials'));
    }

    public function update(Request $request, $module, $id)
    {
        $data = $request->validate([
            'ip_address'  => 'nullable|string|max:100',
            'device_info' => 'nullable|string|max:255',
            'active'      => 'boolean',
        ]);

        $record = Token::findOrFail($id);
        $record->update($data);

        return redirect()
            ->route('admin.module.index', ['module' => $module])
            ->with('success', 'Token atualizado com sucesso!');
    }

    public function destroy(Request $request, $module, $id)
    {
        Token::findOrFail($id)->delete();

        return redirect()->route('admin.module.index', ['module' => $module]);
    }

    public function restore(Request $request, $module, $id)
    {
        Token::withTrashed()->findOrFail($id)->restore();

        return redirect()->route('admin.module.index', ['module' => $module]);
    }
}
