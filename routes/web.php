<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // <--- INI BARIS YANG HILANG TADI
use App\Http\Controllers\EmergencyController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// --- GROUP 1: MASYARAKAT / PUBLIK ---
// Role: 'masyarakat' (Sesuai Seeder & Register Controller)
Route::middleware(['auth', 'role:masyarakat, super_admin'])->group(function () {

    // Dashboard utama untuk masyarakat (Halaman SOS)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Fitur Order Ambulan
    Route::get('/emergency/create', [EmergencyController::class, 'create'])->name('emergency.create');
    Route::post('/emergency', [EmergencyController::class, 'store'])->name('emergency.store');
});


// --- GROUP 2A: SUPER ADMIN (IT) ---
// Fokus: Manajemen Sistem, Data Master, Settings
Route::middleware(['auth', 'role:super_admin'])->prefix('super-admin')->group(function () {
    // Dashboard Super Admin (Sistem)
    Route::get('/dashboard', function () {
        $stats = [
            'total_users' => \App\Models\User::count(),
            'total_hospitals' => \App\Models\Hospital::count(),
            'total_basecamps' => \App\Models\Basecamp::count(),
            'total_ambulances' => \App\Models\Ambulance::count(),
        ];
        return view('admin.dashboard', compact('stats'));
    })->name('super-admin.dashboard');

    // Route User Management (Super Admin only)
    Route::resource('users', \App\Http\Controllers\UserController::class)->names([
        'index' => 'admin.users.index',
        'create' => 'users.create',
        'store' => 'admin.users.store',
        'edit' => 'users.edit',
        'update' => 'users.update',
        'destroy' => 'users.destroy',
    ]);

    // Route Master Data: Rumah Sakit (Super Admin only)
    Route::resource('hospitals', \App\Http\Controllers\AdminHospitalController::class)->names('admin.hospitals');
    Route::get('/hospitals-export', [\App\Http\Controllers\AdminHospitalController::class, 'export'])->name('admin.hospitals.export');
    Route::post('/hospitals-import', [\App\Http\Controllers\AdminHospitalController::class, 'import'])->name('admin.hospitals.import');

    // Route Master Data: Puskesmas (Super Admin only)
    Route::resource('basecamps', \App\Http\Controllers\AdminBasecampController::class)->names('admin.basecamps');

    // Route Master Data: Ambulan (Super Admin only)
    Route::resource('ambulances', \App\Http\Controllers\AdminAmbulanceController::class)->names('admin.ambulances');

    // Route Audit Log (Super Admin only)
    Route::get('/audit-logs', [\App\Http\Controllers\AdminAuditLogController::class, 'index'])->name('admin.logs.index');

    // Route Pengaturan Sistem (Super Admin only)
    Route::get('/settings', [\App\Http\Controllers\AdminSettingController::class, 'index'])->name('admin.settings.index');
    Route::put('/settings', [\App\Http\Controllers\AdminSettingController::class, 'update'])->name('admin.settings.update');

    // Route Broadcast Notification (Super Admin only)
    Route::get('/notifications', [\App\Http\Controllers\AdminNotificationController::class, 'index'])->name('admin.notifications.index');
    Route::get('/notifications/create', [\App\Http\Controllers\AdminNotificationController::class, 'create'])->name('admin.notifications.create');
    Route::post('/notifications', [\App\Http\Controllers\AdminNotificationController::class, 'store'])->name('admin.notifications.store');
    Route::post('/notifications/{id}/read', [\App\Http\Controllers\AdminNotificationController::class, 'markAsRead'])->name('admin.notifications.read');
});

// --- GROUP 2B: ADMIN DINAS KESEHATAN (OPERASIONAL) ---
// Fokus: Monitoring, Laporan, Statistik
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    // Dashboard Admin Dinas (Operasional Monitoring)
    Route::get('/dashboard', [\App\Http\Controllers\AdminDinkesController::class, 'dashboard'])->name('admin.dashboard');

    // Monitoring Kejadian (Laporan)
    Route::get('/reports', [\App\Http\Controllers\AdminDinkesController::class, 'reports'])->name('admin.dinkes.reports');

    // Monitoring Armada (Ambulans)
    Route::get('/ambulances-monitor', [\App\Http\Controllers\AdminDinkesController::class, 'ambulances'])->name('admin.dinkes.ambulances');

    // Monitoring RS (Ketersediaan Bed)
    Route::get('/hospitals-monitor', [\App\Http\Controllers\AdminDinkesController::class, 'hospitals'])->name('admin.dinkes.hospitals');

    // Modul Inventori (Stok, Oksigen, Obat, ATK)
    Route::get('/inventory', [\App\Http\Controllers\AdminDinkesController::class, 'inventoryIndex'])->name('admin.dinkes.inventory.index');
    Route::post('/inventory', [\App\Http\Controllers\AdminDinkesController::class, 'inventoryStore'])->name('admin.dinkes.inventory.store');

    // Modul Logistik (Service & BBM)
    Route::get('/logistics', [\App\Http\Controllers\AdminDinkesController::class, 'logisticIndex'])->name('admin.dinkes.logistics.index');
    Route::post('/logistics', [\App\Http\Controllers\AdminDinkesController::class, 'logisticStore'])->name('admin.dinkes.logistics.store');

    // Modul Utilitas (Listrik & PAM)
    Route::get('/utilities', [\App\Http\Controllers\AdminDinkesController::class, 'utilityIndex'])->name('admin.dinkes.utilities.index');
    Route::post('/utilities', [\App\Http\Controllers\AdminDinkesController::class, 'utilityStore'])->name('admin.dinkes.utilities.store');

    // Rekap Pasien AH
    Route::get('/patient-recap', [\App\Http\Controllers\AdminDinkesController::class, 'patientRecap'])->name('admin.dinkes.patient-recap');
});

// --- GROUP 3: OPERATOR (CALL CENTER) ---
// Role: operator
Route::middleware(['auth', 'role:operator,super_admin'])->prefix('operator')->group(function () {
    Route::get('/dashboard', function () {
        // Pastikan buat file: resources/views/operator/dashboard.blade.php
        return view('operator.dashboard');
    })->name('operator.dashboard');
});


// --- GROUP 4: TIM LAPANGAN (AMBULAN) ---
// Prefix URL kita ubah jadi 'lapangan' agar konsisten dengan folder view
Route::middleware(['auth', 'role:driver,nakes,peserta_bhd,super_admin'])->prefix('lapangan')->group(function () {

    Route::get('/dashboard', function () {
        // 1. Ambil Data Diri Driver
        $user = auth()->user();
        $ambulance = \App\Models\Ambulance::where('driver_id', $user->id)->first();

        $activeJob = null;

        // 2. Cek Apakah Ada Tugas Aktif?
        if ($ambulance) {
            $activeJob = \App\Models\EmergencyCall::where('ambulance_id', $ambulance->id)
                ->whereIn('status', ['pending', 'process'])
                ->latest()
                ->first();
        }

        // 3. (BARU) Ambil Data RS untuk Tabel Rujukan
        // Kita urutkan berdasarkan ketersediaan bed IGD (terbanyak di atas)
        $hospitals = \App\Models\Hospital::orderBy('available_bed_igd', 'desc')->get();

        // 4. Kirim semua variabel ke View
        return view('lapangan.dashboard', compact('ambulance', 'activeJob', 'hospitals'));

    })->name('lapangan.dashboard');

    Route::post('/finish-job/{id}', [\App\Http\Controllers\EmergencyController::class, 'finishJob'])->name('lapangan.finish');
});


// --- GROUP 5: FASKES (RUMAH SAKIT & PUSKESMAS) ---
// Menggabungkan: rumahsakit, klinik_utama, puskesmas, lab_medik
Route::middleware(['auth', 'role:rumahsakit,klinik_utama,puskesmas,lab_medik,super_admin]'])->prefix('faskes')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\HospitalController::class, 'index'])->name('faskes.dashboard');
    Route::put('/hospital/{id}/update-status', [\App\Http\Controllers\HospitalController::class, 'update'])->name('faskes.update');
});


// --- ROUTE PROFIL (UMUM) ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';