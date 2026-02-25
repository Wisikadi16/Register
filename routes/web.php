<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EmergencyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\LapanganController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Depan (Landing Page)
Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->post('/notifications/read', [\App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.read');

// ====================================================
// GROUP 1: MASYARAKAT / PUBLIK
// ====================================================
Route::middleware(['auth', 'role:masyarakat'])->group(function () {

    // Dashboard utama untuk masyarakat (Halaman SOS)
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'masyarakat'])->name('dashboard');

    // Fitur Publik (Faskes & P3K)
    Route::get('/layanan/faskes', [\App\Http\Controllers\PublicFeatureController::class, 'indexFaskes'])->name('public.faskes');
    Route::get('/layanan/p3k', [\App\Http\Controllers\PublicFeatureController::class, 'indexP3K'])->name('public.p3k');
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
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'superAdmin'])->name('super-admin.dashboard');

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
Route::middleware(['auth', 'role:admin,super_admin,sie_rujukan'])->prefix('admin')->group(function () {

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
    Route::patch('/logistics/{id}/mark-as-completed', [\App\Http\Controllers\AdminDinkesController::class, 'logisticMarkAsCompleted'])->name('admin.dinkes.logistics.mark-as-completed');
    Route::delete('/logistics/{id}', [\App\Http\Controllers\AdminDinkesController::class, 'logisticDestroy'])->name('admin.dinkes.logistics.destroy');

    // Modul Utilitas
    Route::get('/utilities', [\App\Http\Controllers\AdminDinkesController::class, 'utilityIndex'])->name('admin.dinkes.utilities.index');
    Route::post('/utilities', [\App\Http\Controllers\AdminDinkesController::class, 'utilityStore'])->name('admin.dinkes.utilities.store');
    Route::get('/utilities/{id}/edit', [\App\Http\Controllers\AdminDinkesController::class, 'utilityEdit'])->name('admin.dinkes.utilities.edit');
    Route::put('/utilities/{id}', [\App\Http\Controllers\AdminDinkesController::class, 'utilityUpdate'])->name('admin.dinkes.utilities.update');
    Route::patch('/utilities/{id}/mark-as-paid', [\App\Http\Controllers\AdminDinkesController::class, 'utilityMarkAsPaid'])->name('admin.dinkes.utilities.mark-as-paid');
    Route::delete('/utilities/{id}', [\App\Http\Controllers\AdminDinkesController::class, 'utilityDestroy'])->name('admin.dinkes.utilities.destroy');

    // Modul Maintenance (Baru)
    Route::resource('maintenance', \App\Http\Controllers\AdminMaintenanceController::class)->names('admin.dinkes.maintenance');

    // Modul Referral / Rujukan (Baru)
    Route::get('/referrals', [\App\Http\Controllers\AdminReferralController::class, 'index'])->name('admin.dinkes.referrals.index');
    Route::put('/referrals/{id}', [\App\Http\Controllers\AdminReferralController::class, 'update'])->name('admin.dinkes.referrals.update');

    // Rekap Pasien
    Route::get('/patient-recap', [\App\Http\Controllers\AdminDinkesController::class, 'patientRecap'])->name('admin.dinkes.patient-recap');

});


// ====================================================
// GROUP 3: OPERATOR (CALL CENTER)
// ====================================================
Route::middleware(['auth', 'role:operator,super_admin,ka'])->prefix('operator')->group(function () {
    // 1. Dashboard Utama
    Route::get('/dashboard', [\App\Http\Controllers\OperatorController::class, 'dashboard'])->name('operator.dashboard');

    // 2. Menu Input Jadwal
    Route::get('/schedules', [\App\Http\Controllers\OperatorController::class, 'scheduleIndex'])->name('operator.schedules.index');
    Route::post('/schedules', [\App\Http\Controllers\OperatorController::class, 'scheduleStore'])->name('operator.schedules.store');

    // Rekap & Input Pasien
    Route::get('/reports', [\App\Http\Controllers\OperatorController::class, 'reports'])->name('operator.reports.index');
    Route::get('/reports/create', [\App\Http\Controllers\OperatorController::class, 'createPatient'])->name('operator.reports.create');
    Route::post('/reports/store', [\App\Http\Controllers\OperatorController::class, 'storePatient'])->name('operator.reports.store');

    // 4. Menu Ambulan Swasta
    Route::get('/ambulances/private', [\App\Http\Controllers\OperatorController::class, 'privateAmbulances'])->name('operator.ambulances.private');

    // 5. Menu Hubungi Driver
    Route::get('/contacts', [\App\Http\Controllers\OperatorController::class, 'contacts'])->name('operator.contacts.index');

    // Action Routes (Assign/Cancel/Dst - Tetap Menggunakan EmergencyController untuk Logic Bisnis)
    Route::post('/emergency/{id}/assign', [\App\Http\Controllers\EmergencyController::class, 'assignAmbulance'])->name('operator.emergency.assign');
    Route::post('/emergency/{id}/cancel', [\App\Http\Controllers\EmergencyController::class, 'cancelCall'])->name('operator.emergency.cancel');
    Route::post('/emergency/{id}/set-destination', [\App\Http\Controllers\EmergencyController::class, 'setDestination'])->name('operator.emergency.set-destination');

    // Manajemen Tiket Faskes (Operator)
    Route::get('/requests', [\App\Http\Controllers\FacilityRequestController::class, 'operatorIndex'])->name('operator.requests.index');
    Route::post('/requests/{id}/process', [\App\Http\Controllers\FacilityRequestController::class, 'operatorUpdate'])->name('operator.requests.update');
});


// ====================================================
// GROUP 4: TIM LAPANGAN (DRIVER & NAKES)
// ====================================================
Route::middleware(['auth', 'role:driver,peserta_bhd'])->prefix('lapangan')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'lapangan'])->name('lapangan.dashboard');

    Route::post('/finish-job/{id}', [\App\Http\Controllers\LapanganController::class, 'finishJob'])->name('lapangan.finish');
    Route::post('/medical-record', [\App\Http\Controllers\LapanganController::class, 'storeMedicalRecord'])->name('lapangan.medical-record.store');
    Route::post('/panic-button', [\App\Http\Controllers\LapanganController::class, 'panicButton'])->name('lapangan.panic-button');
    Route::post('/update-status', [\App\Http\Controllers\LapanganController::class, 'updateStatus'])->name('lapangan.update-status');
    Route::post('/disaster-report', [\App\Http\Controllers\LapanganController::class, 'storeDisasterReport'])->name('lapangan.disaster-report.store');

    // Fitur Baru: Jadwal Driver
    Route::get('/schedules', [\App\Http\Controllers\LapanganController::class, 'scheduleIndex'])->name('lapangan.schedules.index');
    Route::post('/schedules', [\App\Http\Controllers\LapanganController::class, 'scheduleStore'])->name('lapangan.schedules.store');

    // Fitur Baru: Pesan/Inbox
    Route::get('/messages', [\App\Http\Controllers\LapanganController::class, 'messagesIndex'])->name('lapangan.messages.index');

    // Fitur Baru: Laporan Sterilisasi
    Route::get('/sterilizations', [\App\Http\Controllers\LapanganController::class, 'sterilizationCreate'])->name('lapangan.sterilizations.create');
    Route::post('/sterilizations', [\App\Http\Controllers\LapanganController::class, 'sterilizationStore'])->name('lapangan.sterilizations.store');

    // Fitur Baru: Respon Time / Kinerja
    Route::get('/performance', [\App\Http\Controllers\LapanganController::class, 'performanceIndex'])->name('lapangan.performance.index');
});


// ====================================================
// GROUP 5: FASKES (RS & PUSKESMAS)
// ====================================================
Route::middleware(['auth', 'role:rumahsakit,klinik_utama,puskesmas,lab_medik'])->prefix('faskes')->group(function () {
    Route::get('/dashboard', [HospitalController::class, 'index'])->name('faskes.dashboard');
    Route::post('/update', [HospitalController::class, 'update'])->name('faskes.update');
    // Tiket Laporan Logistik & Maintenance (Faskes)
    Route::get('/requests', [\App\Http\Controllers\FacilityRequestController::class, 'faskesIndex'])->name('faskes.requests.index');
    Route::post('/requests', [\App\Http\Controllers\FacilityRequestController::class, 'faskesStore'])->name('faskes.requests.store');
});


// ====================================================
// PROFILE ROUTES
// ====================================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




// ====================================================
// GROUP 6: ATEM (TEKNISI)
// ====================================================
Route::middleware(['auth', 'role:atem'])->prefix('atem')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\AtemController::class, 'dashboard'])->name('atem.dashboard');
    Route::get('/input-data', [\App\Http\Controllers\AtemController::class, 'inputData'])->name('atem.data');
    Route::post('/input-data', [\App\Http\Controllers\AtemController::class, 'storeData'])->name('atem.data.store');
    Route::get('/usulan', [\App\Http\Controllers\AtemController::class, 'inputUsulan'])->name('atem.usulan');
    Route::post('/usulan', [\App\Http\Controllers\AtemController::class, 'storeUsulan'])->name('atem.usulan.store');
});

// ====================================================
// GROUP BARU: LAB PUSKESMAS / MEDIK
// ====================================================
Route::middleware(['auth', 'role:puskesmas,lab_medik'])->prefix('puskesmas')->group(function () {

    // Dashboard
    Route::get('/dashboard', [\App\Http\Controllers\LabPuskesmasController::class, 'dashboard'])->name('puskesmas.dashboard');

    // Menu 1: Data Supervisor
    Route::get('/supervisors', [\App\Http\Controllers\LabPuskesmasController::class, 'supervisorIndex'])->name('puskesmas.supervisors.index');
    Route::post('/supervisors', [\App\Http\Controllers\LabPuskesmasController::class, 'supervisorStore'])->name('puskesmas.supervisors.store');

    // Menu 2: Laporan BHD
    Route::get('/bhd-reports', [\App\Http\Controllers\LabPuskesmasController::class, 'bhdIndex'])->name('puskesmas.bhd.index');
    Route::post('/bhd-reports', [\App\Http\Controllers\LabPuskesmasController::class, 'bhdStore'])->name('puskesmas.bhd.store');

    // Tiket Laporan Logistik & Maintenance (Puskesmas)
    Route::get('/requests', [\App\Http\Controllers\FacilityRequestController::class, 'faskesIndex'])->name('puskesmas.requests.index');
    Route::post('/requests', [\App\Http\Controllers\FacilityRequestController::class, 'faskesStore'])->name('puskesmas.requests.store');
});

// ====================================================
// GROUP BARU: NAKES (TEAMS MEDIS UTAMA)
// ====================================================
Route::middleware(['auth', 'role:nakes'])->prefix('nakes')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\NakesController::class, 'dashboard'])->name('nakes.dashboard');

    // Menu 1: Rekap Pasien AH
    Route::get('/patients', [\App\Http\Controllers\NakesController::class, 'patientRecap'])->name('nakes.patients.index');

    // Menu 2: Input Data Pasien
    Route::get('/patients/create', [\App\Http\Controllers\NakesController::class, 'inputDataPasien'])->name('nakes.patients.create');
    Route::post('/patients', [\App\Http\Controllers\NakesController::class, 'storePatientData'])->name('nakes.patients.store');

    // Menu 3: Laporan Usulan
    Route::get('/reports', [\App\Http\Controllers\NakesController::class, 'laporanUsulan'])->name('nakes.reports.index');
    Route::post('/reports', [\App\Http\Controllers\NakesController::class, 'storeUsulan'])->name('nakes.reports.store');
});

// ROUTE KLINIK UTAMA
Route::middleware(['auth', 'role:klinik_utama'])->prefix('klinik-utama')->name('klinik.')->group(function () {
    // Menampilkan Halaman Menu Klinik Utama
    Route::get('/dashboard', [App\Http\Controllers\KlinikUtamaController::class, 'dashboard'])->name('dashboard');

    // Menu Data SPV Klinik Utama
    Route::get('/spv', [App\Http\Controllers\KlinikUtamaController::class, 'spvIndex'])->name('spv.index');
    Route::post('/spv/store', [App\Http\Controllers\KlinikUtamaController::class, 'spvStore'])->name('spv.store');

    // Menu Input Data Ambulan
    Route::get('/ambulan', [App\Http\Controllers\KlinikUtamaController::class, 'ambulanIndex'])->name('ambulan.index');
    Route::post('/ambulan/store', [App\Http\Controllers\KlinikUtamaController::class, 'ambulanStore'])->name('ambulan.store');
});

// ====================================================
// GROUP KA (Koor / Sub Koor)
// ====================================================
Route::middleware(['auth', 'role:ka'])->prefix('ka')->name('ka.')->group(function () {
    // Menampilkan Halaman Menu KA (Dashboard)
    Route::get('/dashboard', [\App\Http\Controllers\KaController::class, 'dashboard'])->name('dashboard');

    // Tampilan Laporan
    Route::get('/laporan/pasien-tertangani', [\App\Http\Controllers\KaController::class, 'laporanPasien'])->name('laporan.pasien');
    Route::get('/laporan/team', [\App\Http\Controllers\KaController::class, 'laporanTeam'])->name('laporan.team');
    Route::get('/laporan/rekam-data', [\App\Http\Controllers\KaController::class, 'laporanRekamData'])->name('laporan.rekam');

    // Tampilan Validasi Laporan
    Route::get('/validasi', [\App\Http\Controllers\KaController::class, 'validasiIndex'])->name('validasi.index');

    // Export Routes
    Route::get('/laporan/pasien-tertangani/export-excel', [\App\Http\Controllers\KaController::class, 'exportExcel'])->name('laporan.pasien.excel');
    Route::get('/laporan/pasien-tertangani/export-pdf', [\App\Http\Controllers\KaController::class, 'exportPdf'])->name('laporan.pasien.pdf');
});


require __DIR__ . '/auth.php';

// ==========================================
// GROUP SIE RUJUKAN (PENILAIAN & VALIDASI)
// ==========================================
Route::middleware(['auth', 'role:sie_rujukan'])->prefix('sie-rujukan')->name('sie.')->group(function () {
    // 1. Dashboard
    Route::get('/dashboard', [\App\Http\Controllers\SieRujukanController::class, 'dashboard'])->name('dashboard');

    // 2. Menu Supervisi (SPV)
    Route::get('/spv-puskesmas', [\App\Http\Controllers\SieRujukanController::class, 'spvPuskesmas'])->name('spv.puskesmas');
    Route::post('/spv-puskesmas', [\App\Http\Controllers\SieRujukanController::class, 'storeSpvPuskesmas']);
    Route::get('/spv-rs', [\App\Http\Controllers\SieRujukanController::class, 'spvRs'])->name('spv.rs');
    Route::post('/spv-rs', [\App\Http\Controllers\SieRujukanController::class, 'storeSpvRs']);
    Route::get('/spv-lab', [\App\Http\Controllers\SieRujukanController::class, 'spvLab'])->name('spv.lab');
    Route::post('/spv-lab', [\App\Http\Controllers\SieRujukanController::class, 'storeSpvLab']);
    Route::get('/spv-klinik', [\App\Http\Controllers\SieRujukanController::class, 'spvKlinik'])->name('spv.klinik');
    Route::post('/spv-klinik', [\App\Http\Controllers\SieRujukanController::class, 'storeSpvKlinik']);

    // 3. Menu Validasi & Penilaian
    Route::get('/pkp-puskesmas', [\App\Http\Controllers\SieRujukanController::class, 'pkpPuskesmas'])->name('pkp.puskesmas');
    Route::post('/pkp-puskesmas', [\App\Http\Controllers\SieRujukanController::class, 'storePkpPuskesmas']);
    Route::get('/validasi-jadwal', [\App\Http\Controllers\SieRujukanController::class, 'validasiJadwal'])->name('validasi.jadwal');
    Route::post('/validasi-jadwal', [\App\Http\Controllers\SieRujukanController::class, 'storeValidasiJadwal']);
    Route::get('/validasi-lplpo', [\App\Http\Controllers\SieRujukanController::class, 'validasiLplpo'])->name('validasi.lplpo');
    Route::post('/validasi-lplpo', [\App\Http\Controllers\SieRujukanController::class, 'storeValidasiLplpo']);
    Route::get('/validasi-ah', [\App\Http\Controllers\SieRujukanController::class, 'validasiAh'])->name('validasi.ah');
    Route::post('/validasi-ah', [\App\Http\Controllers\SieRujukanController::class, 'storeValidasiAh']);
    Route::get('/stratifikasi-rs', [\App\Http\Controllers\SieRujukanController::class, 'stratifikasiRs'])->name('stratifikasi.rs');
    Route::post('/stratifikasi-rs', [\App\Http\Controllers\SieRujukanController::class, 'storeStratifikasiRs']);

    // 4. Laporan Tambahan
    Route::get('/laporan-bhd', [\App\Http\Controllers\SieRujukanController::class, 'laporanBhd'])->name('laporan.bhd');
    Route::post('/laporan-bhd', [\App\Http\Controllers\SieRujukanController::class, 'storeLaporanBhd']);
});