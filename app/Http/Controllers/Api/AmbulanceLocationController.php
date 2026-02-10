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
        // Ambil data latitude & longitude yang tidak null
        $ambulances = Ambulance::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get([
                'id',
                'name',
                'plat_number',
                'latitude',
                'longitude',
                'status',
                'last_location_update'
            ]);

        // Format data agar lebih mudah dibaca frontend
        $data = $ambulances->map(function ($amb) {
            // Cek apakah data offline (lebih dari 1 jam tidak update)
            $lastUpdate = \Carbon\Carbon::parse($amb->last_location_update);
            $isOffline = $lastUpdate->diffInHours(now()) > 1;

            return [
                'id' => $amb->id,
                'name' => $amb->name,
                'plat_number' => $amb->plat_number,
                'latitude' => $amb->latitude,
                'longitude' => $amb->longitude,
                'status' => $isOffline ? 'offline' : $amb->status, // Override status jika offline
                'last_update' => $lastUpdate->diffForHumans(),
                'speed' => '0 km/h', // Placeholder
            ];
        });

        return response()->json($data);
    }
}