<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Basecamp;
use App\Models\Hospital;
use App\Models\Ambulance;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Password default untuk semua akun dummy agar mudah diingat
        $password = Hash::make('password');

        // ==========================================
        // 1. KELOMPOK ADMIN & MANAJEMEN
        // ==========================================

        // 1. Super Admin (IT)
        User::create([
            'name' => 'IT Super Admin',
            'email' => 'it@admin.com',
            'password' => $password,
            'role' => 'super_admin',
        ]);

        // 2. Admin Dinkes
        User::create([
            'name' => 'Admin Dinkes',
            'email' => 'admin@dinkes.com',
            'password' => $password,
            'role' => 'admin',
        ]);

        // 3. KA (Koordinator)
        User::create([
            'name' => 'Ibu Koordinator',
            'email' => 'ka@dinkes.com',
            'password' => $password,
            'role' => 'ka',
        ]);

        // 4. Sie Rujukan
        User::create([
            'name' => 'Petugas Rujukan',
            'email' => 'sie@dinkes.com',
            'password' => $password,
            'role' => 'sie_rujukan',
        ]);

        // 5. Atem (Teknisi Alat)
        User::create([
            'name' => 'Teknisi Atem',
            'email' => 'atem@ah.com',
            'password' => $password,
            'role' => 'atem',
        ]);


        // ==========================================
        // 2. KELOMPOK OPERASIONAL (CALL CENTER)
        // ==========================================

        // 6. Operator 112
        User::create([
            'name' => 'Operator Command Center',
            'email' => 'operator@ah.com',
            'password' => $password,
            'role' => 'operator',
        ]);


        // ==========================================
        // 3. KELOMPOK LAPANGAN (TIM MEDIS)
        // ==========================================

        // 7. Driver Ambulan (KITA SIMPAN KE VARIABEL AGAR BISA DIPAKAI DI BAWAH)
        $driver1 = User::create([
            'name' => 'Driver Ambulan 01',
            'email' => 'driver@ah.com',
            'password' => $password,
            'role' => 'driver',
        ]);

        // 8. Nakes (Dokter/Perawat Pendamping)
        User::create([
            'name' => 'Nakes Pendamping',
            'email' => 'nakes@ah.com',
            'password' => $password,
            'role' => 'nakes',
        ]);

        // 9. Peserta BHD (Relawan)
        User::create([
            'name' => 'Relawan BHD',
            'email' => 'bhd@ah.com',
            'password' => $password,
            'role' => 'peserta_bhd',
        ]);


        // ==========================================
        // 4. KELOMPOK FASKES (PARTNER)
        // ==========================================

        // 10. Rumah Sakit
        User::create([
            'name' => 'Admin RS Karyadi',
            'email' => 'rs@ah.com',
            'password' => $password,
            'role' => 'rumahsakit',
        ]);

        // 11. Puskesmas (Basecamp)
        User::create([
            'name' => 'Admin PKM Pandanaran',
            'email' => 'pkm@ah.com',
            'password' => $password,
            'role' => 'puskesmas',
        ]);

        // 12. Klinik Utama
        User::create([
            'name' => 'Admin Klinik Sehat',
            'email' => 'klinik@ah.com',
            'password' => $password,
            'role' => 'klinik_utama',
        ]);

        // 13. Lab Medik
        User::create([
            'name' => 'Admin Lab Prodia',
            'email' => 'lab@ah.com',
            'password' => $password,
            'role' => 'lab_medik',
        ]);


        // ==========================================
        // 5. KELOMPOK PUBLIK
        // ==========================================

        // 14. Masyarakat (User Biasa)
        User::create([
            'name' => 'Warga Semarang',
            'email' => 'warga@gmail.com',
            'password' => $password,
            'role' => 'masyarakat', // SUDAH DIPERBAIKI (Tadi ada spasi)
        ]);


        // ==========================================
        // DATA WILAYAH & FASKES (MASTER DATA)
        // ==========================================

        // 1. DATA BASECAMP (PUSKESMAS SEMARANG)
        $pkm_pandanaran = Basecamp::create([
            'name' => 'Puskesmas Pandanaran',
            'phone' => '024-8310000',
            'latitude' => -6.986687,
            'longitude' => 110.413254,
        ]);

        $pkm_srondol = Basecamp::create([
            'name' => 'Puskesmas Srondol',
            'phone' => '024-7470000',
            'latitude' => -7.050516,
            'longitude' => 110.420455,
        ]);

        $pkm_halmahera = Basecamp::create([
            'name' => 'Puskesmas Halmahera',
            'phone' => '024-8410000',
            'latitude' => -6.990450,
            'longitude' => 110.430500,
        ]);

        Basecamp::create([
            'name' => 'Puskesmas Karangayu',
            'phone' => '024-7600000',
            'latitude' => -6.981500,
            'longitude' => 110.395000,
        ]);

        Basecamp::create([
            'name' => 'Puskesmas Bulu Lor',
            'phone' => '024-3540000',
            'latitude' => -6.970000,
            'longitude' => 110.410000,
        ]);

        // 2. DATA RS RUJUKAN
        Hospital::create([
            'name' => 'RSUP Dr. Kariadi',
            'phone_igd' => '024-8413476',
            'address' => 'Jl. Dr. Sutomo No.16, Semarang',
            'latitude' => -6.993478,
            'longitude' => 110.408546,
            'available_bed_igd' => 10,
            'available_bed_icu' => 2,
        ]);

        Hospital::create([
            'name' => 'RSUD K.R.M.T Wongsonegoro (Ketileng)',
            'phone_igd' => '024-6711500',
            'address' => 'Jl. Fatmawati No.1, Semarang',
            'latitude' => -7.020850,
            'longitude' => 110.460120,
            'available_bed_igd' => 5,
            'available_bed_icu' => 0, // Penuh
        ]);

        Hospital::create([
            'name' => 'RS Telogorejo',
            'phone_igd' => '024-8446000',
            'address' => 'Jl. KH. Ahmad Dahlan, Semarang',
            'latitude' => -6.985500,
            'longitude' => 110.405000,
            'available_bed_igd' => 8,
            'available_bed_icu' => 3,
        ]);


        // 3. DATA ARMADA AMBULAN
        // Linkkan Ambulan 01 ke Driver yang sudah kita simpan di variabel $driver1
        Ambulance::create([
            'plat_number' => 'H 9901 AH',
            'name' => 'Ambulan Hebat 01',
            'basecamp_id' => $pkm_pandanaran->id,
            'status' => 'ready',
            'current_latitude' => -6.986687,
            'current_longitude' => 110.413254,
            'driver_id' => $driver1->id, // OTOMATIS BENAR (Milik 'driver@ah.com')
        ]);

        Ambulance::create([
            'plat_number' => 'H 9902 AH',
            'name' => 'Ambulan Hebat 02',
            'basecamp_id' => $pkm_pandanaran->id,
            'status' => 'busy',
            'current_latitude' => -6.980000,
            'current_longitude' => 110.415000,
            'driver_id' => null, // Belum ada driver
        ]);

        Ambulance::create([
            'plat_number' => 'H 9903 AH',
            'name' => 'Ambulan Hebat 03',
            'basecamp_id' => $pkm_srondol->id,
            'status' => 'ready',
            'current_latitude' => -7.050516,
            'current_longitude' => 110.420455,
            'driver_id' => null,
        ]);

        Ambulance::create([
            'plat_number' => 'H 9904 AH',
            'name' => 'Ambulan Hebat 04',
            'basecamp_id' => $pkm_halmahera->id,
            'status' => 'maintenance',
            'current_latitude' => -6.990450,
            'current_longitude' => 110.430500,
            'driver_id' => null,
        ]);

        // ==========================================
        // Seeder Settings (Konfigurasi Global)
        // ==========================================
        $this->call(SettingSeeder::class);
    }
}