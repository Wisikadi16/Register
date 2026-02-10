<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ambulance;
use Illuminate\Http\Request;

class AmbulanceLocationController extends Controller
{
    // Update lokasi (Dipakai oleh Driver / Script Simulasi)
    public function update(Request $request, $id)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $ambulance = Ambulance::findOrFail($id);
        
        $ambulance->update([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'last_location_update' => now(),
        ]);

        return response()->json([
            'message' => 'Lokasi berhasil diperbarui',
            'data' => $ambulance
        ]);
    }

    // Ambil lokasi (Dipakai oleh Dashboard Warga/Admin)
    public function show($id)
    {
        $ambulance = Ambulance::findOrFail($id);

        return response()->json([
            'unit' => $ambulance->name,
            'latitude' => $ambulance->latitude,
            'longitude' => $ambulance->longitude,
            'last_update' => $ambulance->last_location_update ? $ambulance->last_location_update->diffForHumans() : 'Belum ada data',
            'status' => $ambulance->status
        ]);
    }
    
    // Ambil SEMUA lokasi (Dipakai oleh Dashboard Admin Monitoring)
    public function all()
    {
        // Hanya ambil ambulan yang aktif dan punya lokasi
        $ambulances = Ambulance::where('is_active', true)
            ->whereNotNull('latitude')
            ->get(['id', 'unit_number', 'police_number', 'latitude', 'longitude', 'status']);

        return response()->json($ambulances);
    }
}