<?php

namespace App\Http\Controllers;

use App\Models\Ambulance;
use App\Models\EmergencyCall;
use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LapanganController extends Controller
{
    /**
     * Menampilkan Dashboard untuk Driver, Nakes, dan Peserta BHD.
     * Logic: Mencari ambulan yang dikendarai user, lalu cek apakah ada SOS aktif.
     */
    public function index()
    {
        $user = Auth::user();
        
        // 1. Cari ambulan yang driver_id-nya adalah ID user yang sedang login
        $ambulance = Ambulance::where('driver_id', $user->id)->first();
        
        $activeJob = null;
        if ($ambulance) {
            // 2. Cari panggilan SOS yang ditugaskan ke ambulan ini
            // Status: 'pending' (baru), 'dispatched' (dikirim), atau 'process' (sedang ditangani)
            $activeJob = EmergencyCall::where('ambulance_id', $ambulance->id)
                ->whereIn('status', ['pending', 'process', 'dispatched'])
                ->with('user') // Mengambil data masyarakat yang memanggil
                ->latest()
                ->first();
        }

        // 3. Ambil data Rumah Sakit untuk keperluan rujukan (disortir bed terbanyak)
        $hospitals = Hospital::orderBy('available_bed_igd', 'desc')->get();

        return view('lapangan.dashboard', compact('activeJob', 'hospitals', 'ambulance'));
    }

    /**
     * Menandakan tugas telah selesai.
     * Mengembalikan status ambulan menjadi 'ready'.
     */
    public function finishJob($id)
    {
        $job = EmergencyCall::findOrFail($id);
        
        // Update status panggilan menjadi completed
        $job->update(['status' => 'completed']);

        // Update status ambulan kembali menjadi ready agar bisa dipanggil lagi oleh sistem
        if ($job->ambulance_id) {
            Ambulance::where('id', $job->ambulance_id)->update(['status' => 'ready']);
        }

        return redirect()->route('lapangan.dashboard')->with('success', 'Tugas selesai! Status Anda kembali standby.');
    }
}