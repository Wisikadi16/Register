<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiePkpPuskesmas;
use App\Models\SieSpvPuskesmas;
use App\Models\SieSpvRs;
use App\Models\SieSpvLab;
use App\Models\SieSpvKlinik;
use App\Models\SieValidasiJadwal;
use App\Models\SieValidasiLplpo;
use App\Models\SieValidasiAh;
use App\Models\SieStratifikasiRs;
use App\Models\SieLaporanBhd;

class SieRujukanController extends Controller
{
    // Halaman Utama
    public function dashboard()
    {
        return view('sie-rujukan.dashboard');
    }

    // --- Kelompok 1: Supervisi (SPV) ---
    public function spvPuskesmas()
    {
        $data = SieSpvPuskesmas::latest()->get();
        return view('sie-rujukan.spv-puskesmas', compact('data'));
    }

    public function storeSpvPuskesmas(Request $request)
    {
        SieSpvPuskesmas::create($request->all());
        return back()->with('success', 'Data Supervisi Puskesmas berhasil disimpan!');
    }

    public function spvRs()
    {
        $data = SieSpvRs::latest()->get();
        return view('sie-rujukan.spv-rs', compact('data'));
    }

    public function storeSpvRs(Request $request)
    {
        SieSpvRs::create($request->all());
        return back()->with('success', 'Data Supervisi Rumah Sakit berhasil disimpan!');
    }

    public function spvLab()
    {
        $data = SieSpvLab::latest()->get();
        return view('sie-rujukan.spv-lab', compact('data'));
    }

    public function storeSpvLab(Request $request)
    {
        SieSpvLab::create($request->all());
        return back()->with('success', 'Data Supervisi Laboratorium berhasil disimpan!');
    }

    public function spvKlinik()
    {
        $data = SieSpvKlinik::latest()->get();
        return view('sie-rujukan.spv-klinik', compact('data'));
    }

    public function storeSpvKlinik(Request $request)
    {
        SieSpvKlinik::create($request->all());
        return back()->with('success', 'Data Supervisi Klinik berhasil disimpan!');
    }

    // --- Kelompok 2: Penilaian & Validasi ---
    public function pkpPuskesmas()
    {
        $data = SiePkpPuskesmas::latest()->get();
        return view('sie-rujukan.pkp-puskesmas', compact('data'));
    }

    public function storePkpPuskesmas(Request $request)
    {
        SiePkpPuskesmas::create($request->all());
        return back()->with('success', 'Data PKP Puskesmas berhasil disimpan!');
    }

    public function validasiJadwal()
    {
        $data = SieValidasiJadwal::latest()->get();
        return view('sie-rujukan.validasi-jadwal', compact('data'));
    }

    public function storeValidasiJadwal(Request $request)
    {
        $input = $request->all();
        $input['sah'] = $request->has('sah') ? 'Ya' : 'Tidak';
        SieValidasiJadwal::create($input);
        return back()->with('success', 'Validasi Jadwal berhasil disimpan!');
    }

    public function validasiLplpo()
    {
        $data = SieValidasiLplpo::latest()->get();
        return view('sie-rujukan.validasi-lplpo', compact('data'));
    }

    public function storeValidasiLplpo(Request $request)
    {
        $input = $request->all();
        $input['sah'] = $request->has('sah') ? 'Ya' : 'Tidak';
        SieValidasiLplpo::create($input);
        return back()->with('success', 'Validasi LPLPO berhasil disimpan!');
    }

    public function validasiAh()
    {
        $data = SieValidasiAh::latest()->get();
        return view('sie-rujukan.validasi-ah', compact('data'));
    }

    public function storeValidasiAh(Request $request)
    {
        $input = $request->all();
        $input['valid'] = $request->has('valid') ? 'Ya' : 'Tidak';
        SieValidasiAh::create($input);
        return back()->with('success', 'Validasi Data AH berhasil disimpan!');
    }

    public function stratifikasiRs()
    {
        $data = SieStratifikasiRs::latest()->get();
        return view('sie-rujukan.stratifikasi-rs', compact('data'));
    }

    public function storeStratifikasiRs(Request $request)
    {
        SieStratifikasiRs::create($request->all());
        return back()->with('success', 'Data Stratifikasi RS berhasil disimpan!');
    }

    // --- Kelompok 3: Laporan ---
    public function laporanBhd()
    {
        $data = SieLaporanBhd::latest()->get();
        return view('sie-rujukan.laporan-bhd', compact('data'));
    }

    public function storeLaporanBhd(Request $request)
    {
        SieLaporanBhd::create($request->all());
        return back()->with('success', 'Data Laporan BHD berhasil disimpan!');
    }
}
