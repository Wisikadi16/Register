<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;

class AdminHospitalController extends Controller
{
    // Menampilkan daftar RS
    public function index()
    {
        $hospitals = Hospital::all();
        return view('admin.hospitals.index', compact('hospitals'));
    }

    // Form Tambah RS
    public function create()
    {
        return view('admin.hospitals.create');
    }

    // Simpan RS Baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone_igd' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'available_bed_igd' => 'required|integer',
            'available_bed_icu' => 'required|integer',
        ]);

        Hospital::create($request->all());

        return redirect()->route('admin.hospitals.index')->with('success', 'Rumah Sakit berhasil ditambahkan.');
    }

    // Form Edit RS
    public function edit($id)
    {
        $hospital = Hospital::findOrFail($id);
        return view('admin.hospitals.edit', compact('hospital'));
    }

    // Update RS
    public function update(Request $request, $id)
    {
        $hospital = Hospital::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone_igd' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'available_bed_igd' => 'required|integer',
            'available_bed_icu' => 'required|integer',
        ]);

        $hospital->update($request->all());

        return redirect()->route('admin.hospitals.index')->with('success', 'Data Rumah Sakit berhasil diperbarui.');
    }

    // Hapus RS
    public function destroy($id)
    {
        Hospital::findOrFail($id)->delete();
        return redirect()->route('admin.hospitals.index')->with('success', 'Rumah Sakit berhasil dihapus.');
    }
}
