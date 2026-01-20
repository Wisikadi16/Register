<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun ADMIN (Otomatis)
        User::create([
            'name' => 'Admin Pusat',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'usertype' => 'admin', // <--- PENTING!
        ]);

        // 2. Buat Akun WARGA (Untuk Tes)
        User::create([
            'name' => 'Warga Biasa',
            'email' => 'warga@gmail.com',
            'password' => Hash::make('password'),
            'usertype' => 'user',
        ]);
    }
}