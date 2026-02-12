<?php

namespace App\Http\Controllers;

use App\Models\EmergencyCall;
use App\Models\Ambulance;
use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // <--- Tambahkan Library Storage

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
            'description' => 'nullable|string', // Ubah jadi nullable
            'photo' => 'nullable|image|max:5120', // Max 5MB
        ]);

        $userLat = $request->latitude;
        $userLng = $request->longitude;

        // Handle File Upload
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('emergency_photos', 'public');
        }

        // 2. Ambil Semua Ambulan yang 'READY' saja
        $readyAmbulances = Ambulance::where('status', 'ready')->get();

        $assignedAmbulance = null;
        $shortestDistance = null;
        $status = 'pending'; // Default status jika tidak dapat ambulan

        // 3. Logika DSS (Jika ada ambulan ready)
        if ($readyAmbulances->isNotEmpty()) {
            $shortestDistance = 999999999;
            foreach ($readyAmbulances as $ambulance) {
                // Pastikan ambulan punya lokasi GPS valid
                if ($ambulance->current_latitude && $ambulance->current_longitude) {
                    $distance = $this->calculateDistance(
                        $userLat,
                        $userLng,
                        $ambulance->current_latitude,
                        $ambulance->current_longitude
                    );

                    if ($distance < $shortestDistance) {
                        $shortestDistance = $distance;
                        $assignedAmbulance = $ambulance;
                    }
                }
            }
        }

        // 4. Tentukan Data untuk Disimpan
        $callData = [
            'user_id' => Auth::id(),
            'latitude' => $userLat,
            'longitude' => $userLng,
            'location' => "{$userLat}, {$userLng}",
            'description' => $request->description ?? 'Panggilan Darurat (Tanpa Keterangan)',
            'photo' => $photoPath, // Simpan path foto
            'ambulance_id' => null, // Default
            'status' => 'pending', // Default
        ];

        $callData['ambulance_id'] = null; 
        $callData['status'] = 'pending'; 

        if ($assignedAmbulance) {
            
            $message = 'Permintaan terkirim! Sistem mendeteksi ambulan terdekat (' . $assignedAmbulance->name . '). Mohon tunggu konfirmasi Operator.';
        } else {
            $message = 'Mohon tunggu! Permintaan Anda telah masuk. Operator kami sedang mencarikan unit ambulan untuk Anda.';
        }

        EmergencyCall::create($callData);

        return redirect()->route('dashboard')->with('success', $message);
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

    // MANUAL DISPATCH (Untuk Operator)
    public function assignAmbulance(Request $request, $id)
    {
        $request->validate([
            'ambulance_id' => 'required|exists:ambulances,id',
        ]);

        $emergencyCall = EmergencyCall::findOrFail($id);
        $newAmbulance = Ambulance::findOrFail($request->ambulance_id);

        // Validasi: Pastikan ambulan baru statusnya READY (kecuali memaksa/override, tapi sementara kita strict dulu)
        // if ($newAmbulance->status != 'ready') {
        //     return redirect()->back()->with('error', 'Gagal menugaskan. Ambulan ' . $newAmbulance->name . ' sedang sibuk (BUSY).');
        // }

        // 1. Jika sudah ada ambulan sebelumnya, bebaskan (set ready)
        if ($emergencyCall->ambulance_id) {
            $oldAmbulance = Ambulance::find($emergencyCall->ambulance_id);
            if ($oldAmbulance) {
                $oldAmbulance->update(['status' => 'ready']);
            }
        }

        // 2. Update Emergency Call
        $emergencyCall->update([
            'ambulance_id' => $newAmbulance->id,
            'status' => 'process', // Langsung set process
        ]);

        // 3. Set Status Ambulan Baru jadi BUSY
        $newAmbulance->update(['status' => 'busy']);

        // 4. Catat Audit Log (Jika model AuditLog ada)
        if (class_exists(\App\Models\AuditLog::class)) {
            \App\Models\AuditLog::record(
                'Manual Dispatch',
                'Operator menugaskan ambulan ' . $newAmbulance->name . ' untuk kejadian ID: ' . $emergencyCall->id
            );
        }

        return redirect()->back()->with('success', 'Ambulan ' . $newAmbulance->name . ' berhasil ditugaskan secara manual.');
    }

    // BATALKAN PANGGILAN
    public function cancelCall(Request $request, $id)
    {
        $request->validate([
            'cancellation_note' => 'required|string|max:255',
        ]);

        $emergencyCall = EmergencyCall::findOrFail($id);

        // Jika sudah selesai, tidak bisa dibatalkan
        if ($emergencyCall->status == 'completed') {
            return redirect()->back()->with('error', 'Panggilan yang sudah selesai tidak dapat dibatalkan.');
        }

        // Release Ambulan jika ada
        if ($emergencyCall->ambulance_id) {
            $ambulance = Ambulance::find($emergencyCall->ambulance_id);
            if ($ambulance) {
                $ambulance->update(['status' => 'ready']);
            }
        }

        $emergencyCall->update([
            'status' => 'cancelled',
            'description' => $emergencyCall->description . " [DIBATALKAN: " . $request->cancellation_note . "]",
        ]);

        if (class_exists(\App\Models\AuditLog::class)) {
            \App\Models\AuditLog::record(
                'Cancel Call',
                'Operator membatalkan panggilan ID: ' . $id . '. Alasan: ' . $request->cancellation_note
            );
        }

        return redirect()->back()->with('success', 'Panggilan berhasil dibatalkan dan armada telah dibebaskan.');
    }

    // SET RUMAH SAKIT TUJUAN
    public function setDestination(Request $request, $id)
    {
        $request->validate([
            'hospital_id' => 'required|exists:hospitals,id',
        ]);

        $emergencyCall = EmergencyCall::findOrFail($id);
        $hospital = Hospital::findOrFail($request->hospital_id);

        $emergencyCall->update([
            'hospital_id' => $hospital->id,
        ]);

        if (class_exists(\App\Models\AuditLog::class)) {
            \App\Models\AuditLog::record(
                'Set Destination',
                'Operator menetapkan tujuan RS: ' . $hospital->name . ' untuk kejadian ID: ' . $id
            );
        }

        return redirect()->back()->with('success', 'Tujuan rujukan berhasil ditetapkan ke ' . $hospital->name);
    }
}