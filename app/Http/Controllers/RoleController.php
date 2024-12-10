<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $listRole = Role::all();
        return view('admin.role.index', compact('listRole'));
    }

    public function create()
    {
        return view('admin.role.create');
    }

    public function store(RoleRequest $request)
    {
        $validasi = $request->validated();
        Role::create($validasi);

        return redirect()->route('role.index')->with('success', 'Role berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $role = Role::findOrFail($id);

        return view('admin.role.show', compact('role'));
    }

    public function edit(string $id)
    {
        $role = Role::findOrFail($id);

        return view('admin.role.edit', compact('role'));
    }

    public function update(RoleRequest $request, string $id)
    {
        $role = Role::findOrFail($id);
        $validasi = $request->validated();
        $role->update($validasi);

        return redirect()->route('role.index')->with('success', 'Role berhasil diubah');
    }

    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('role.index')->with('success', 'Role berhasil dihapus');
    }
}
