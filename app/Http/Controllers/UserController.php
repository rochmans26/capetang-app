<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:lihat-user')->only(['index', 'show']);
        $this->middleware('permission:tambah-user')->only(['create', 'store']);
        $this->middleware('permission:ubah-user')->only(['edit', 'update']);
        $this->middleware('permission:hapus-user')->only(['destroy']);
    }

    public function index()
    {
        $listUser = User::paginate(10);
        return view('admin.user.index', compact('listUser'));
    }

    public function create()
    {
        $listRole = Role::all();
        return view('admin.user.create', compact('listRole'));
    }

    public function store(UserRequest $request)
    {
        $validasi = $request->validated();
        $validasi['password'] = Hash::make($validasi['password']);
        $role = Role::findOrFail($validasi['role']);
        $user = User::create($validasi);

        // Upload foto
        if ($request->hasFile('foto')) {
            $user->foto = $user->uploadImage($validasi['foto']);
            $user->save();
        }

        // Tambahkan role user dan sync permissionnya
        $user->assignRole($role->name);
        if ($role) {
            $user->syncPermissions($role->permissions);
        }

        // Kirim email verifikasi
        event(new Registered($user));

        return redirect()->route('kelola-pengguna.index')->with('success', 'Pengguna berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $user = User::findOrFail($id);

        return view('admin.user.show', compact('user'));
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $listRole = Role::all();

        return view('admin.user.edit', compact('user', 'listRole'));
    }

    public function update(UserRequest $request, string $id)
    {
        $validasi = $request->validated();
        $user = User::findOrFail($id);
        $role = Role::findOrFail($validasi['role']);

        if (!empty($validasi['password'])) {
            $validasi['password'] = Hash::make($validasi['password']);
        } else {
            unset($validasi['password']);
        }

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
            $user->save();
        }

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            $user->deleteImage($user->foto ?? null);
            // Simpan foto baru
            $validasi['foto'] = $user->uploadImage($request->file('foto'));
        }

        $user->update($validasi);
        // Sync roles dengan menghapus semua role yang dimiliki oleh user
        $user->roles()->detach();
        $user->syncRoles($role->name);

        // Sync permissions dengan menghapus semua permission yang dimiliki oleh user
        $user->permissions()->detach();
        $user->syncPermissions($role->permissions->pluck('name')->toArray());

        return redirect()->route('kelola-pengguna.index')->with('success', 'Pengguna berhasil diubah');
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if ($user->foto) {
            $user->deleteImage($user->foto ?? null);
        }

        // Melepas semua permission yang dimiliki oleh user
        $user->roles()->detach();
        // Melepas semua permission yang dimiliki oleh user
        $user->permissions()->detach();
        // Hapus data user
        $user->delete();

        return redirect()->route('kelola-pengguna.index')->with('success', 'Pengguna berhasil dihapus');
    }
}
