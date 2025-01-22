<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Item;
use App\Models\KategoriSampah;
use App\Models\Quest;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        // Role Seeder
        $this->call([
            RoleAndPermissionSeeder::class,
        ]);
        KategoriSampah::factory()->createMany([
            ['nama_kategori' => 'Sampah Kertas'],
            ['nama_kategori' => 'Sampah Kaleng'],
            ['nama_kategori' => 'Sampah Plastik'],
            ['nama_kategori' => 'Sampah Kaca'],
        ]);

        Quest::factory(10)->create();

        Item::factory(15)->create();
    }
}
