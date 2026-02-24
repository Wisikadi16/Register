<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmergencyCall;
use App\Models\NakesReport;
use App\Models\MedicalRecord;
use Illuminate\Support\Facades\Auth;

class NakesController extends Controller
{
    // 1. Menu Landing / Dashboard
    public function dashboard()
    {
        return view('nakes.dashboard');
    }

    // 2. Menu Rekap Pasien AH (Semua riwayat pasien darurat)
    public function patientRecap()
    {
        // Ambil pasien yang sudah selesai ditangani
        $patients = EmergencyCall::where('status', 'resolved')
            ->latest()
            ->paginate(10);
        return view('nakes.patients.index', compact('patients'));
    }

    // 3. Menu Input Data Pasien (Medis)
    public function inputDataPasien()
    {
        // Bisa menampilkan form input atau pasien yang butuh diinput datanya
        return view('nakes.patients.create');
    }

    // Simpan Data Pasien
    public function storePatientData(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|numeric',
            'tensi' => 'nullable|string',
            'nadi' => 'nullable|numeric',
            'suhu' => 'nullable|numeric',
            'nafas' => 'nullable|numeric',
            'diagnosis' => 'nullable|string',
            'tindakan' => 'nullable|string',
        ]);

        // Buat EmergencyCall manual dengan status resolved
        $call = EmergencyCall::create([
            'user_id' => Auth::id(), // Gunakan ID Nakes yang menginput sebagai pelapor
            'caller_name' => $request->nama,
            'caller_phone' => $request->nik, // Simpan NIK di caller_phone untuk manual
            'description' => $request->diagnosis ?? 'Catatan Medis Nakes',
            'status' => 'resolved',
            'location' => 'Input Manual Nakes',
            'latitude' => -6.986687, // Default koordinat semarang
            'longitude' => 110.413254,
        ]);

        // Buat Medical Record
        MedicalRecord::create([
            'emergency_call_id' => $call->id,
            'tensi' => $request->tensi,
            'nadi' => $request->nadi,
            'suhu' => $request->suhu,
            'nafas' => $request->nafas,
            'keluhan_utama' => $request->diagnosis,
            'tindakan' => $request->tindakan,
            'keterangan' => 'NIK: ' . $request->nik,
        ]);

        return redirect()->route('nakes.patients.index')->with('success', 'Data rekam medis pasien berhasil disimpan!');
    }

    // 4. Menu Input Laporan Usulan (Tampil & Form Input)
    public function laporanUsulan()
    {
        $reports = NakesReport::where('user_id', Auth::id())->latest()->get();
        return view('nakes.reports.index', compact('reports'));
    }

    // Simpan Usulan
    public function storeUsulan(Request $request)
    {
        $request->validate([
            'judul_usulan' => 'required|string|max:255',
            'deskripsi' => 'required|string'
        ]);

        NakesReport::create([
            'user_id' => Auth::id(),
            'judul_usulan' => $request->judul_usulan,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->back()->with('success', 'Usulan berhasil dikirim!');
    }
}
