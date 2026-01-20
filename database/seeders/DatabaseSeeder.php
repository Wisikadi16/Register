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
            'email' => 'it@admin.com',
            'password' => Hash::make('password'),
            'usertype' => 'super_admin', 
        ]);

    }
}