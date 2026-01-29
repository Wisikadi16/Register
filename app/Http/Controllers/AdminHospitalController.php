<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Exports\HospitalsExport;
use App\Imports\HospitalsImport;
use Maatwebsite\Excel\Facades\Excel;
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

    // Simpan Rumah Sakit Baru
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

        $hospital = Hospital::create($request->all());

        \App\Models\AuditLog::record('CREATE', 'Menambahkan Rumah Sakit baru: ' . $hospital->name);

        return redirect()->route('admin.hospitals.index')->with('success', 'Rumah Sakit berhasil ditambahkan.');
    }

    // Form Edit Rumah Sakit
    public function edit($id)
    {
        $hospital = Hospital::findOrFail($id);
        return view('admin.hospitals.edit', compact('hospital'));
    }

    // Update Rumah Sakit
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

        \App\Models\AuditLog::record('UPDATE', 'Mengupdate data Rumah Sakit: ' . $hospital->name);

        return redirect()->route('admin.hospitals.index')->with('success', 'Data Rumah Sakit berhasil diperbarui.');
    }

    // Hapus Rumah Sakit
    public function destroy($id)
    {
        $hospital = Hospital::findOrFail($id);
        $name = $hospital->name;
        $hospital->delete();

        \App\Models\AuditLog::record('DELETE', 'Menghapus Rumah Sakit: ' . $name);

        return redirect()->route('admin.hospitals.index')->with('success', 'Rumah Sakit berhasil dihapus.');
    }

    // Export to Excel
    public function export()
    {
        return Excel::download(new HospitalsExport, 'hospitals_' . date('Y-m-d') . '.xlsx');
    }

    // Import from Excel
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        Excel::import(new HospitalsImport, $request->file('file'));

        \App\Models\AuditLog::record('IMPORT', 'Mengimport data Rumah Sakit dari file Excel');

        return redirect()->route('admin.hospitals.index')->with('success', 'Data berhasil diimport!');
    }
}
