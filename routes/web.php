<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmergencyController;
use App\Http\Controllers\UserController;    

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- RUANGAN USER / MASYARAKAT ---
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/emergency/create', [EmergencyController::class, 'create'])->name('emergency.create');
    Route::post('/emergency', [EmergencyController::class, 'store'])->name('emergency.store');
});


// --- RUANGAN ADMIN & SUPER ADMIN---
Route::middleware(['auth', 'role:admin,super_admin'])->group(function () {
    
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard'); 
    })->name('admin.dashboard');

    // DAFTAR LENGKAP ROUTE USER (WAJIB ADA SEMUA)
    Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/admin/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/admin/users', [UserController::class, 'store'])->name('users.store');
    
    // Baris di bawah ini yang menyebabkan error jika hilang:
    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

// --- RUANGAN AMBULAN ---
Route::middleware(['auth', 'role:ambulan'])->prefix('ambulan')->group(function () {
    Route::get('/dashboard', function () {
        return view('ambulan.dashboard');
    })->name('ambulan.dashboard');
});
require __DIR__.'/auth.php';