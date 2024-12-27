<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:lihat-role')->only(['index', 'show']);
        $this->middleware('permission:tambah-role')->only(['create', 'store']);
        $this->middleware('permission:ubah-role')->only(['edit', 'update']);
        $this->middleware('permission:hapus-role')->only(['destroy']);
    }

    public function index()
    {
        $listRole = Role::all();
        return view('admin.role.index', compact('listRole'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('admin.role.create', compact('permissions'));
    }

    public function store(RoleRequest $request)
    {
        $validasi = $request->validated();
        // Konversi array permission ke array integer
        $permissionsID = array_map('intval', $validasi['permission'] ?? []);
        // Buat role baru
        $role = Role::create($validasi);
        if ($role) {
            // Sync data permissions untuk role yang baru
            $role->syncPermissions($permissionsID);
            return redirect()->route('role.index')->with('success', 'Role berhasil ditambahkan');
        }

        return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan role');
    }

    public function show(string $id)
    {
        $role = Role::findOrFail($id);

        return view('admin.role.show', compact('role'));
    }

    public function edit(string $id)
    {
        $role = Role::findOrFail($id);
        // Ambil semua permissions yang tersedia
        $permissions = Permission::all();
        // Ambil ID permissions yang sudah dimiliki role
        $rolePermissions = $role->permissions->pluck('id')->toArray();

        return view('admin.role.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(RoleRequest $request, string $id)
    {
        $role = Role::findOrFail($id);
        $validasi = $request->validated();
        // Konversi array permission ke array integer
        $permissionsID = array_map('intval', $validasi['permission']);
        // Melepas semua permission yang dimiliki role
        $role->permissions()->detach();

        // Melepas semua permission yang dimiliki oleh user
        $users = $role->users;
        foreach ($users as $user) {
            $user->permissions()->detach();
        }

        // Perbarui data role
        $role->update($validasi);
        // Sync data permissions untuk user yang memiliki role ini
        $role->syncPermissions($permissionsID);
        foreach ($users as $user) {
            $user->syncPermissions($permissionsID);
        }

        return redirect()->route('role.index')->with('success', 'Role berhasil diubah');
    }

    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        // Melepas semua permission yang dimiliki oleh user
        $users = $role->users;
        foreach ($users as $user) {
            $user->permissions()->detach($role->permissions->pluck('id'));
        }

        // Melepas semua permission yang dimiliki oleh role
        $role->permissions()->detach();
        // Melepas semua user yang memiliki role ini
        $role->users()->detach();
        // Hapus role
        $role->delete();

        return redirect()->route('role.index')->with('success', 'Role berhasil dihapus');
    }
}
