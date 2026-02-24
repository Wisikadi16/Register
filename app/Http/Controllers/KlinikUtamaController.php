<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SieSpvKlinik; // Pastikan model ini sudah sesuai
use App\Models\Ambulance;    // Model Ambulan standar Anda
use Illuminate\Support\Facades\Auth;

class KlinikUtamaController extends Controller
{
    // Menampilkan Dashboard Utama
    public function dashboard()
    {
        return view('klinik-utama.dashboard');
    }

    // Menampilkan Halaman SPV
    public function spvIndex()
    {
        // Ambil data SPV milik klinik ini saja
        $spvs = SieSpvKlinik::where('klinik_id', Auth::id())->get();
        return view('klinik-utama.spv.index', compact('spvs'));
    }

    // Menyimpan Data SPV
    public function spvStore(Request $request)
    {
        $request->validate([
            'kategori' => 'required|string',
            'inspeksi' => 'required|string',
        ]);

        SieSpvKlinik::create([
            'klinik_id' => Auth::id(), // ID user klinik yang login
            'kategori' => $request->kategori,
            'inspeksi' => $request->inspeksi,
        ]);

        return redirect()->route('klinik.spv.index')->with('success', 'Data SPV Klinik berhasil disimpan!');
    }

    // Menampilkan Halaman Input Ambulan
    public function ambulanIndex()
    {
        // Jika Anda memiliki kolom 'faskes_id' atau sejenisnya di tabel ambulances
        // Sesuaikan dengan struktur database Anda.
        return view('klinik-utama.ambulan.index');
    }

    // Menyimpan Data Ambulan
    public function ambulanStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'plat_number' => 'required|string',
        ]);

        // Simpan data ambulan baru. Pastikan tabel ambulances mendukung ini.
        Ambulance::create([
            'name' => $request->name,
            'plat_number' => $request->plat_number,
            'status' => 'ready', // Enum values allowed: ready, busy, maintenance
            'basecamp_id' => 1,  // Wajib diisi karena struktur db mengharuskan basecamp_id
            // 'faskes_id' => Auth::id(), // Uncomment/sesuaikan jika ada foreign key kepemilikan
        ]);

        return redirect()->route('klinik.ambulan.index')->with('success', 'Data Ambulan berhasil ditambahkan!');
    }
}
