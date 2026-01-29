<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'emergency_phone',
                'value' => '119',
                'label' => 'Nomor Telepon Darurat',
                'type' => 'number',
            ],
            [
                'key' => 'ambulance_radius',
                'value' => '10',
                'label' => 'Radius Pencarian Ambulan (KM)',
                'type' => 'number',
            ],
            [
                'key' => 'dashboard_announcement',
                'value' => 'Selamat Datang di Sistem SPGDT Medzone. Utamakan kecepatan dan keselamatan!',
                'label' => 'Pengumuman Dashboard',
                'type' => 'textarea',
            ],
            [
                'key' => 'site_name',
                'value' => 'Medzone SPGDT',
                'label' => 'Nama Aplikasi',
                'type' => 'text',
            ],
            [
                'key' => 'footer_text',
                'value' => '© 2026 Medzone. All rights reserved.',
                'label' => 'Teks Footer',
                'type' => 'text',
            ],
        ];

        foreach ($settings as $setting) {
            \App\Models\Setting::create($setting);
        }
    }
}
