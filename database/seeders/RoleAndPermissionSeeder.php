<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Permission Seeder
        $permissions = [
            // Dashboard
            ['name' => 'lihat-dashboard', 'description' => 'Melihat dashboard'],

            // Setor Sampah Resource
            ['name' => 'lihat-penyetoran-sampah', 'description' => 'Melihat penyetoran sampah'],
            ['name' => 'tambah-penyetoran-sampah', 'description' => 'Menambah penyetoran sampah'],
            ['name' => 'ubah-penyetoran-sampah', 'description' => 'Mengedit penyetoran sampah'],
            ['name' => 'hapus-penyetoran-sampah', 'description' => 'Menghapus penyetoran sampah'],

            // Role Resource
            ['name' => 'lihat-role', 'description' => 'Melihat role'],
            ['name' => 'tambah-role', 'description' => 'Menambah role'],
            ['name' => 'ubah-role', 'description' => 'Mengedit role'],
            ['name' => 'hapus-role', 'description' => 'Menghapus role'],

            // Quest Resource
            ['name' => 'lihat-quest', 'description' => 'Melihat quest'],
            ['name' => 'tambah-quest', 'description' => 'Menambah quest'],
            ['name' => 'ubah-quest', 'description' => 'Mengedit quest'],
            ['name' => 'hapus-quest', 'description' => 'Menghapus quest'],

            // Profile Resource
            ['name' => 'ubah-profile', 'description' => 'Mengedit profile'],
            ['name' => 'hapus-profile', 'description' => 'Menghapus profile'],
            ['name' => 'ubah-password', 'description' => 'Mengedit password'],

            // Kategori Sampah Resource
            ['name' => 'lihat-kategori-sampah', 'description' => 'Melihat kategori sampah'],
            ['name' => 'tambah-kategori-sampah', 'description' => 'Menambah kategori sampah'],
            ['name' => 'ubah-kategori-sampah', 'description' => 'Mengedit kategori sampah'],
            ['name' => 'hapus-kategori-sampah', 'description' => 'Menghapus kategori sampah'],

            // Item Resource
            ['name' => 'lihat-item', 'description' => 'Melihat item'],
            ['name' => 'tambah-item', 'description' => 'Menambah item'],
            ['name' => 'ubah-item', 'description' => 'Mengedit item'],
            ['name' => 'hapus-item', 'description' => 'Menghapus item'],

            // User Resource
            ['name' => 'lihat-user', 'description' => 'Melihat user'],
            ['name' => 'tambah-user', 'description' => 'Menambah user'],
            ['name' => 'ubah-user', 'description' => 'Mengedit user'],
            ['name' => 'hapus-user', 'description' => 'Menghapus user'],

            // Riwayat Transaksi Resource
            ['name' => 'lihat-riwayat-transaksi', 'description' => 'Melihat riwayat transaksi'],

            // Gamifikasi Resource
            ['name' => 'ambil-quest', 'description' => 'Mengambil quest'],
            ['name' => 'batalkan-quest', 'description' => 'Membatalkan quest'],
            ['name' => 'perbarui-quest', 'description' => 'Perbarui bukti penyerahan quest'],
            ['name' => 'kirimkan-reward', 'description' => 'Mengirimkan reward point kepada user'],

            // Penukaran Poin Resource
            ['name' => 'lihat-penukaran-poin', 'description' => 'Melihat penukaran poin'],
            ['name' => 'tambah-penukaran-poin', 'description' => 'Menambah penukaran poin'],
            ['name' => 'ubah-penukaran-poin', 'description' => 'Mengedit penukaran poin'],
            ['name' => 'hapus-penukaran-poin', 'description' => 'Menghapus penukaran poin'],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['name' => $permission['name']],
                ['description' => $permission['description']]
            );
        }

        $listPermissionsUser = [
            'lihat-dashboard',
            'lihat-riwayat-transaksi',
            'lihat-kategori-sampah',
            'lihat-quest',
            'lihat-item',
            'ambil-quest',
            'batalkan-quest',
            'perbarui-quest',
            'lihat-penukaran-poin',
            'ubah-profile',
            'ubah-password',
        ];

        // Role Seeder
        $roleUser = Role::firstOrCreate(['name' => 'user', 'description' => 'User Role']);
        $roleAdmin = Role::firstOrCreate(['name' => 'admin', 'description' => 'Admin Role']);

        // Assign Permission to Role User
        $permissionsUser = Permission::whereIn('name', $listPermissionsUser)->get();
        $roleUser->syncPermissions($permissionsUser);

        // Assign Role and Permission to User
        $user = User::where('email', 'test@example.com')->first();
        $user->assignRole($roleUser);
        $user->syncPermissions($roleUser->permissions);

        // Assign Permission to Role Admin
        $permissionsAdmin = Permission::all();
        $roleAdmin->syncPermissions($permissionsAdmin);

        // Assign Role and Permission to Admin
        $admin = User::where('email', 'admin@example.com')->first();
        $admin->assignRole($roleAdmin);
        $admin->syncPermissions($roleAdmin->permissions);
    }
}
