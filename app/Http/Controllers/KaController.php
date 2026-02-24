<?php

namespace App\Http\Controllers;

use App\Models\EmergencyCall;
use Illuminate\Http\Request;

class KaController extends Controller
{
    public function dashboard()
    {
        return view("ka.dashboard");
    }

    public function laporanPasien()
    {
        $laporan = EmergencyCall::where('status', 'completed')->get();
        return view('ka.laporan.pasien-tertangani', compact('laporan'));
    }

    public function laporanTeam()
    {
        return view("ka.laporan.team");
    }

    public function laporanRekamData()
    {
        return view("ka.laporan.rekam");
    }

    public function validasiIndex()
    {
        return view("ka.validasi.index");
    }

    public function exportExcel()
    {
        $laporan = EmergencyCall::where('status', 'completed')->get();

        $fileName = 'Laporan_Pasien_Tertangani_' . date('Y-m-d') . '.csv';
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function () use ($laporan) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Nama Pelapor', 'Nomor Telepon', 'Jenis Darurat', 'Lokasi Kejadian', 'Tanggal Laporan']);

            foreach ($laporan as $row) {
                fputcsv($file, [
                    $row->id,
                    $row->caller_name,
                    $row->caller_phone,
                    $row->emergency_type,
                    $row->location,
                    $row->created_at->format('Y-m-d H:i:s')
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPdf()
    {
        $laporan = EmergencyCall::where('status', 'completed')->get();
        // Menggunakan view khusus print agar lebih ringan dan tanpa sidebar
        return view('ka.laporan.print-pasien', compact('laporan'));
    }
}
