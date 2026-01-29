<?php

namespace App\Http\Controllers;

use App\Models\Ambulance;
use App\Models\Basecamp;
use App\Models\User;
use Illuminate\Http\Request;

class AdminAmbulanceController extends Controller
{
    // Menampilkan daftar Ambulan
    public function index()
    {
        // Eager load basecamp dan driver agar efisien
        $ambulances = Ambulance::with(['basecamp', 'driver'])->get();
        return view('admin.ambulances.index', compact('ambulances'));
    }

    // Form Tambah Ambulan
    public function create()
    {
        // Ambil data untuk dropdown
        $basecamps = Basecamp::all();
        // Hanya ambil user dengan role 'driver'
        $drivers = User::where('role', 'driver')->get();

        return view('admin.ambulances.create', compact('basecamps', 'drivers'));
    }

    // Simpan Ambulan Baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'plat_number' => 'required|string|max:20|unique:ambulances',
            'basecamp_id' => 'required|exists:basecamps,id',
            'driver_id' => 'nullable|exists:users,id',
            'status' => 'required|in:ready,busy,maintenance',
        ]);

        // Jika ada driver_id, pastikan driver tsb role-nya benar (opsional tapi bagus)

        Ambulance::create([
            'name' => $request->name,
            'plat_number' => $request->plat_number,
            'basecamp_id' => $request->basecamp_id,
            'driver_id' => $request->driver_id,
            'status' => $request->status,
            // Default koordinat ikut basecamp dulu jika tidak diset, atau set 0
            'current_latitude' => 0,
            'current_longitude' => 0,
        ]);

        \App\Models\AuditLog::record('CREATE', 'Menambahkan Ambulan baru: ' . $request->name . ' (' . $request->plat_number . ')');

        return redirect()->route('admin.ambulances.index')->with('success', 'Ambulan berhasil ditambahkan.');
    }

    // Form Edit Ambulan
    public function edit($id)
    {
        $ambulance = Ambulance::findOrFail($id);
        $basecamps = Basecamp::all();
        $drivers = User::where('role', 'driver')->get();

        return view('admin.ambulances.edit', compact('ambulance', 'basecamps', 'drivers'));
    }

    // Update Ambulan
    public function update(Request $request, $id)
    {
        $ambulance = Ambulance::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'plat_number' => 'required|string|max:20|unique:ambulances,plat_number,' . $id,
            'basecamp_id' => 'required|exists:basecamps,id',
            'driver_id' => 'nullable|exists:users,id',
            'status' => 'required|in:ready,busy,maintenance',
        ]);

        $ambulance->update([
            'name' => $request->name,
            'plat_number' => $request->plat_number,
            'basecamp_id' => $request->basecamp_id,
            'driver_id' => $request->driver_id,
            'status' => $request->status,
        ]);

        \App\Models\AuditLog::record('UPDATE', 'Mengupdate Ambulan: ' . $ambulance->name);

        return redirect()->route('admin.ambulances.index')->with('success', 'Data Ambulan berhasil diperbarui.');
    }

    // Hapus Ambulan
    public function destroy($id)
    {
        $ambulance = Ambulance::findOrFail($id);
        $name = $ambulance->name; // Simpan nama sebelum dihapus
        $ambulance->delete();

        \App\Models\AuditLog::record('DELETE', 'Menghapus Ambulan: ' . $name);

        return redirect()->route('admin.ambulances.index')->with('success', 'Ambulan berhasil dihapus.');
    }
}
