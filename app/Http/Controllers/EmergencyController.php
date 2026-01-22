<?php

namespace App\Http\Controllers;

use App\Models\EmergencyCall;
use App\Models\Ambulance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmergencyController extends Controller
{
    // Menampilkan Form Panggilan Darurat
    public function create()
    {
        return view('emergency.create');
    }

    // Menyimpan Data Panggilan ke Database
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
            'description' => 'required|string',
        ]);
        $userLat = $request->latitude;
        $userLng = $request->longitude;

        //Ambil Semua Ambulan yang 'READY' saja
        $readyAmbulances = Ambulance::where('status', 'ready')->get();

        $nearestAmbulance = null;
        $shortestDistance = 999999999;
        
        //Logika DSS (Looping & hitung jarak)

    foreach ($readyAmbulances as $ambulance) {
            $distance = $this->calculateDistance(
                $userLat,
                $userLng,
                $ambulance->current_latitude,
                $ambulance->current_longitude
            );

            if ($distance < $shortestDistance) {
                $shortestDistance = $distance;
                $nearestAmbulance = $ambulance;
            }
        }

        //cek pencarian
        if(!$nearestAmbulance){
            return redirect()->back()->with('error', 'Maaf, tidak ada ambulan yang tersedia saat ini.');
        }

        //Simpan ke Database
        EmergencyCall::create([
            'user_id' => Auth::id(), 
            'ambulance_id' => $nearestAmbulance->id,
            "latitude" => $userLat,
            "longitude" => $userLng,
            'description' => $request->description,
            'status' => 'pending', 
        ]);
        //update status ambulan jadi 'busy'
        $nearestAmbulance->update(['status' => 'busy']);

        return redirect()->route('dashboard')->with('success', 
            'Ambulan ' . $nearestAmbulance->name . ' sedang menuju lokasi Anda! (Jarak: ' . round($shortestDistance, 2) . ' KM)');
    }
    //RUMUS MATEMATIKA
    //menghitung jarak antara dua titik koordinat 
    private function calculateDistance($lat1, $lng1, $lat2, $lng2)
    {
        $earthRadius = 6371; // Radius bumi dalam kilometer

        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLng / 2) * sin($dLng / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c; // Jarak dalam kilometer
    }
    public function finishJob($id)
    {
        $emergencyCall = EmergencyCall::findOrFail($id);
        $emergencyCall->update(['status' => 'completed']);
        $ambulance = Ambulance::find($emergencyCall->ambulance_id);
        if ($ambulance) {
            $ambulance->update(['status' => 'ready']);
        }
        return redirect()->route('lapangan.dashboard')->with('success', 'Tugas darurat telah selesai, Armada kembali siap (READY)');
    }
}