<?php

namespace App\Http\Controllers;

use App\Models\BhdReport;
use App\Models\PuskesmasSupervisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LabPuskesmasController extends Controller
{
    // 1. Dashboard Utama Puskesmas
    public function dashboard()
    {
        // Hitung total data untuk statistik sederhana
        $totalSpv = PuskesmasSupervisor::where('user_id', Auth::id())->count();
        $totalBhd = BhdReport::where('user_id', Auth::id())->count();
        
        return view('puskesmas.dashboard', compact('totalSpv', 'totalBhd'));
    }

    // 2. Data Supervisor: Tampilkan List
    public function supervisorIndex()
    {
        $supervisors = PuskesmasSupervisor::where('user_id', Auth::id())->latest()->get();
        return view('puskesmas.supervisors.index', compact('supervisors'));
    }

    // 3. Data Supervisor: Simpan Data Baru
    public function supervisorStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'jabatan' => 'required',
        ]);

        PuskesmasSupervisor::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'nip' => $request->nip,
            'jabatan' => $request->jabatan,
            'phone' => $request->phone,
        ]);

        return redirect()->back()->with('success', 'Data Supervisor berhasil ditambahkan.');
    }

    // 4. Laporan BHD: Tampilkan Form & History
    public function bhdIndex()
    {
        $reports = BhdReport::where('user_id', Auth::id())->latest()->get();
        return view('puskesmas.bhd.index', compact('reports'));
    }

    // 5. Laporan BHD: Simpan Laporan
    public function bhdStore(Request $request)
    {
        $request->validate([
            'tanggal_kegiatan' => 'required|date',
            'lokasi' => 'required',
            'jumlah_peserta' => 'required|integer',
            'foto_kegiatan' => 'required|image',
        ]);

        $path = $request->file('foto_kegiatan')->store('bhd_reports', 'public');

        BhdReport::create([
            'user_id' => Auth::id(),
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'lokasi' => $request->lokasi,
            'jumlah_peserta' => $request->jumlah_peserta,
            'keterangan' => $request->keterangan,
            'foto_kegiatan' => $path,
        ]);

        return redirect()->back()->with('success', 'Laporan BHD berhasil dikirim.');
    }
}
