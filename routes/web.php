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
Route::middleware(['auth', 'role:masyarakat'])->group(function () {
    
    // Dashboard utama untuk masyarakat (Halaman SOS)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Fitur Order Ambulan
    Route::get('/emergency/create', [EmergencyController::class, 'create'])->name('emergency.create');
    Route::post('/emergency', [EmergencyController::class, 'store'])->name('emergency.store');
});


// --- GROUP 2: ADMIN & MANAJEMEN ---
// Menggabungkan: admin, super_admin, ka, sie_rujukan, atem
Route::middleware(['auth', 'role:admin,super_admin,ka,sie_rujukan,atem'])->prefix('admin')->group(function () {
    
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); 
    })->name('admin.dashboard');

    // DAFTAR LENGKAP ROUTE USER (MANAJEMEN USER)
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});


// --- GROUP 3: OPERATOR (CALL CENTER) ---
// Role: operator
Route::middleware(['auth', 'role:operator'])->prefix('operator')->group(function () {
    Route::get('/dashboard', function () {
        // Pastikan buat file: resources/views/operator/dashboard.blade.php
        return view('operator.dashboard'); 
    })->name('operator.dashboard');
});


// --- GROUP 4: TIM LAPANGAN (AMBULAN) ---
// Prefix URL kita ubah jadi 'lapangan' agar konsisten dengan folder view
Route::middleware(['auth', 'role:driver,nakes,peserta_bhd'])->prefix('lapangan')->group(function () {
    
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
Route::middleware(['auth', 'role:rumahsakit,klinik_utama,puskesmas,lab_medik'])->prefix('faskes')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\HospitalController::class, 'index'])->name('faskes.dashboard');
    Route::put('/hospital/{id}/update-status', [\App\Http\Controllers\HospitalController::class, 'update'])->name('faskes.update');
});


// --- ROUTE PROFIL (UMUM) ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';