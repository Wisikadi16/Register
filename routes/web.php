<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EmergencyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HospitalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Depan (Landing Page)
Route::get('/', function () {
    return view('welcome');
});

// ====================================================
// GROUP 1: MASYARAKAT / PUBLIK
// ====================================================
Route::middleware(['auth', 'role:masyarakat'])->group(function () {

    // Dashboard utama untuk masyarakat (Halaman SOS)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Fitur SOS (Bisa diakses Admin/Driver untuk testing)
Route::middleware(['auth', 'role:masyarakat,admin,super_admin,driver,operator,rumahsakit'])->group(function () {
    Route::get('/emergency/create', [EmergencyController::class, 'create'])->name('emergency.create');
    Route::post('/emergency', [EmergencyController::class, 'store'])->name('emergency.store');
});


// ====================================================
// GROUP 2A: SUPER ADMIN (IT / SYSTEM OWNER)
// Fokus: Manajemen Sistem, Data Master, Settings
// ====================================================
Route::middleware(['auth', 'role:super_admin'])->prefix('super-admin')->group(function () {

    // Dashboard Super Admin (Statistik Sistem)
    Route::get('/dashboard', function () {
        $stats = [
            'total_users' => \App\Models\User::count(),
            'hospitals' => \App\Models\Hospital::count(),
            'total_basecamps' => \App\Models\Basecamp::count(),
            'total_ambulances' => \App\Models\Ambulance::count(),
            'total_drivers' => \App\Models\User::whereIn('role', ['driver', 'nakes'])->count(),
            'total_calls' => \App\Models\EmergencyCall::count(),
            'active_calls' => \App\Models\EmergencyCall::whereIn('status', ['pending', 'process'])->count(),
        ];
        // Pastikan view admin.dashboard bisa menangima variabel $stats
        return view('admin.dashboard', compact('stats'));
    })->name('super-admin.dashboard');

    // User Management (Full CRUD)
    Route::resource('users', \App\Http\Controllers\UserController::class)->names([
        'index' => 'admin.users.index',
        'create' => 'admin.users.create', // Perbaikan nama route agar konsisten
        'store' => 'admin.users.store',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);

    // Master Data: Rumah Sakit
    Route::resource('hospitals', \App\Http\Controllers\AdminHospitalController::class)->names('admin.hospitals');
    Route::get('/hospitals-export', [\App\Http\Controllers\AdminHospitalController::class, 'export'])->name('admin.hospitals.export');
    Route::post('/hospitals-import', [\App\Http\Controllers\AdminHospitalController::class, 'import'])->name('admin.hospitals.import');

    // Master Data: Puskesmas (Basecamp)
    Route::resource('basecamps', \App\Http\Controllers\AdminBasecampController::class)->names('admin.basecamps');

    // Master Data: Ambulan
    Route::resource('ambulances', \App\Http\Controllers\AdminAmbulanceController::class)->names('admin.ambulances');

    // Audit Log & Settings
    Route::get('/audit-logs', [\App\Http\Controllers\AdminAuditLogController::class, 'index'])->name('admin.logs.index');

    Route::get('/settings', [\App\Http\Controllers\AdminSettingController::class, 'index'])->name('admin.settings.index');
    Route::put('/settings', [\App\Http\Controllers\AdminSettingController::class, 'update'])->name('admin.settings.update');

    // Broadcast Notification
    Route::get('/notifications', [\App\Http\Controllers\AdminNotificationController::class, 'index'])->name('admin.notifications.index');
    Route::get('/notifications/create', [\App\Http\Controllers\AdminNotificationController::class, 'create'])->name('admin.notifications.create');
    Route::post('/notifications', [\App\Http\Controllers\AdminNotificationController::class, 'store'])->name('admin.notifications.store');
    Route::post('/notifications/{id}/read', [\App\Http\Controllers\AdminNotificationController::class, 'markAsRead'])->name('admin.notifications.read');
});


// ====================================================
// GROUP 2B: ADMIN DINAS KESEHATAN (OPERASIONAL)
// Fokus: Monitoring, Laporan, Statistik, Inventori
// ====================================================
Route::middleware(['auth', 'role:admin,super_admin'])->prefix('admin')->group(function () {

    // Dashboard Admin Dinas
    Route::get('/dashboard', [\App\Http\Controllers\AdminDinkesController::class, 'dashboard'])->name('admin.dashboard');

    // Monitoring
    Route::get('/reports', [\App\Http\Controllers\AdminDinkesController::class, 'reports'])->name('admin.dinkes.reports');
    Route::get('/ambulances-monitor', [\App\Http\Controllers\AdminDinkesController::class, 'ambulances'])->name('admin.dinkes.ambulances');
    Route::get('/hospitals-monitor', [\App\Http\Controllers\AdminDinkesController::class, 'hospitals'])->name('admin.dinkes.hospitals');

    // Modul Inventori
    Route::get('/inventory', [\App\Http\Controllers\AdminDinkesController::class, 'inventoryIndex'])->name('admin.dinkes.inventory.index');
    Route::post('/inventory', [\App\Http\Controllers\AdminDinkesController::class, 'inventoryStore'])->name('admin.dinkes.inventory.store');
    // Tambahan untuk Edit/Hapus Inventori (Sesuai To-Do List)
    Route::get('/inventory/{id}/edit', [\App\Http\Controllers\AdminDinkesController::class, 'inventoryEdit'])->name('admin.dinkes.inventory.edit');
    Route::put('/inventory/{id}', [\App\Http\Controllers\AdminDinkesController::class, 'inventoryUpdate'])->name('admin.dinkes.inventory.update');
    Route::delete('/inventory/{id}', [\App\Http\Controllers\AdminDinkesController::class, 'inventoryDestroy'])->name('admin.dinkes.inventory.destroy');

    // Modul Logistik
    Route::get('/logistics', [\App\Http\Controllers\AdminDinkesController::class, 'logisticIndex'])->name('admin.dinkes.logistics.index');
    Route::post('/logistics', [\App\Http\Controllers\AdminDinkesController::class, 'logisticStore'])->name('admin.dinkes.logistics.store');
    Route::get('/logistics/{id}/edit', [\App\Http\Controllers\AdminDinkesController::class, 'logisticEdit'])->name('admin.dinkes.logistics.edit');
    Route::put('/logistics/{id}', [\App\Http\Controllers\AdminDinkesController::class, 'logisticUpdate'])->name('admin.dinkes.logistics.update');
    Route::delete('/logistics/{id}', [\App\Http\Controllers\AdminDinkesController::class, 'logisticDestroy'])->name('admin.dinkes.logistics.destroy');

    // Modul Utilitas
    Route::get('/utilities', [\App\Http\Controllers\AdminDinkesController::class, 'utilityIndex'])->name('admin.dinkes.utilities.index');
    Route::post('/utilities', [\App\Http\Controllers\AdminDinkesController::class, 'utilityStore'])->name('admin.dinkes.utilities.store');
    Route::get('/utilities/{id}/edit', [\App\Http\Controllers\AdminDinkesController::class, 'utilityEdit'])->name('admin.dinkes.utilities.edit');
    Route::put('/utilities/{id}', [\App\Http\Controllers\AdminDinkesController::class, 'utilityUpdate'])->name('admin.dinkes.utilities.update');
    Route::delete('/utilities/{id}', [\App\Http\Controllers\AdminDinkesController::class, 'utilityDestroy'])->name('admin.dinkes.utilities.destroy');

    // Rekap Pasien
    Route::get('/patient-recap', [\App\Http\Controllers\AdminDinkesController::class, 'patientRecap'])->name('admin.dinkes.patient-recap');

    // Integrasi PUSAKA (Dashboard Embed)
    Route::get('/pusaka', function () {
        return view('admin.pusaka');
    })->name('admin.pusaka');
});


// ====================================================
// GROUP 3: OPERATOR (CALL CENTER)
// ====================================================
Route::middleware(['auth', 'role:operator,super_admin,koordinator'])->prefix('operator')->group(function () {
    Route::get('/dashboard', function () {
        $emergencies = \App\Models\EmergencyCall::with(['user', 'ambulance', 'hospital'])
            ->orderBy('created_at', 'desc')->get();
        $ambulances = \App\Models\Ambulance::all();
        $hospitals = \App\Models\Hospital::orderBy('name')->get();
        return view('operator.dashboard', compact('emergencies', 'ambulances', 'hospitals'));
    })->name('operator.dashboard');
    Route::post('/emergency/{id}/assign', [\App\Http\Controllers\EmergencyController::class, 'assignAmbulance'])->name('operator.emergency.assign');
    Route::post('/emergency/{id}/cancel', [\App\Http\Controllers\EmergencyController::class, 'cancelCall'])->name('operator.emergency.cancel');
    Route::post('/emergency/{id}/set-destination', [\App\Http\Controllers\EmergencyController::class, 'setDestination'])->name('operator.emergency.set-destination');
});


// ====================================================
// GROUP 4: TIM LAPANGAN (DRIVER & NAKES)
// ====================================================
Route::middleware(['auth', 'role:driver,nakes,peserta_bhd'])->prefix('lapangan')->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        $ambulance = \App\Models\Ambulance::where('driver_id', $user->id)->first();
        $activeJob = null;

        if ($ambulance) {
            $activeJob = \App\Models\EmergencyCall::where('ambulance_id', $ambulance->id)
                ->whereIn('status', ['pending', 'process'])
                ->latest()->first();
        }
        $hospitals = \App\Models\Hospital::orderBy('available_bed_igd', 'desc')->get();

        return view('lapangan.dashboard', compact('ambulance', 'activeJob', 'hospitals'));
    })->name('lapangan.dashboard');

    Route::post('/finish-job/{id}', [\App\Http\Controllers\EmergencyController::class, 'finishJob'])->name('lapangan.finish');
});


// ====================================================
// GROUP 5: FASKES (RS & PUSKESMAS)
// ====================================================
Route::middleware(['auth', 'role:rumahsakit,klinik_utama,puskesmas,lab_medik'])->prefix('faskes')->group(function () {
    Route::get('/dashboard', [HospitalController::class, 'index'])->name('faskes.dashboard');
    Route::post('/update', [HospitalController::class, 'update'])->name('faskes.update');
});


// ====================================================
// PROFILE ROUTES
// ====================================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';