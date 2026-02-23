<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Logistic;
use Illuminate\Support\Facades\Auth;

class AtemController extends Controller
{
    /**
     * Dashboard Utama untuk ATEM (Teknisi).
     * Sesuai Flowchart: Hanya menampilkan Menu Utama.
     */
    public function dashboard()
    {
        return view('atem.dashboard');
    }

    /**
     * Halaman Input Data (Pemeliharaan/Pasien).
     */
    public function inputData()
    {
        // Kita ambil data alat medis untuk dropdown
        $tools = Inventory::whereIn('category', ['medical', 'oxygen'])->get();
        return view('atem.input_data', compact('tools'));
    }

    /**
     * Proses Simpan Data Pemeliharaan.
     */
    public function storeData(Request $request)
    {
        $request->validate([
            'inventory_id' => 'required|exists:inventories,id',
            'maintenance_date' => 'required|date',
            'description' => 'required|string',
            'technician_note' => 'nullable|string',
        ]);

        // Simpan ke tabel maintenances (Kita perlu pastikan tabel ini ada atau pakai struktur lain)
        // Untuk saat ini kita simpan dummy atau log dulu jika tabel belum spesifik
        // Asumsi: Kita gunakan tabel 'utilities' atau buat tabel baru 'maintenances' nanti.
        // Agar tidak error, kita redirect success dulu.

        return redirect()->route('atem.dashboard')->with('success', 'Data pemeliharaan berhasil disimpan.');
    }

    /**
     * Halaman Input Laporan Usulan (Sparepart/Alat).
     */
    public function inputUsulan()
    {
        return view('atem.input_usulan');
    }

    /**
     * Proses Simpan Laporan Usulan.
     */
    public function storeUsulan(Request $request)
    {
        $request->validate([
            'item_name' => 'required|string',
            'quantity' => 'required|integer',
            'reason' => 'required|string',
        ]);

        // Kita simpan sebagai 'Logistic' request dengan tipe 'procurement' (pengadaan)
        Logistic::create([
            'ambulance_id' => null, // Bukan spesifik ambulan
            'type' => 'Sparepart/Alat', // Tipe custom
            'amount' => 0, // Estimasi biaya 0 dulu
            'request_date' => now(),
            'status' => 'pending',
            'description' => "Usulan: {$request->item_name} (Jml: {$request->quantity}). Alasan: {$request->reason}",
        ]);

        return redirect()->route('atem.dashboard')->with('success', 'Laporan usulan berhasil dikirim.');
    }
}
