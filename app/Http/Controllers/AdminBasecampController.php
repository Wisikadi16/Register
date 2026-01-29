<?php

namespace App\Http\Controllers;

use App\Models\Basecamp;
use Illuminate\Http\Request;

class AdminBasecampController extends Controller
{
    // Menampilkan daftar Puskesmas
    public function index()
    {
        $basecamps = Basecamp::all();
        return view('admin.basecamps.index', compact('basecamps'));
    }

    // Form Tambah Puskesmas
    public function create()
    {
        return view('admin.basecamps.create');
    }

    // Simpan Puskesmas Baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $basecamp = Basecamp::create($request->all());

        \App\Models\AuditLog::record('CREATE', 'Menambahkan Puskesmas baru: ' . $basecamp->name);

        return redirect()->route('admin.basecamps.index')->with('success', 'Puskesmas berhasil ditambahkan.');
    }

    // Form Edit Puskesmas
    public function edit($id)
    {
        $basecamp = Basecamp::findOrFail($id);
        return view('admin.basecamps.edit', compact('basecamp'));
    }

    // Update Puskesmas
    public function update(Request $request, $id)
    {
        $basecamp = Basecamp::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $basecamp->update($request->all());

        \App\Models\AuditLog::record('UPDATE', 'Mengupdate Puskesmas: ' . $basecamp->name);

        return redirect()->route('admin.basecamps.index')->with('success', 'Data Puskesmas berhasil diperbarui.');
    }

    // Hapus Puskesmas
    public function destroy($id)
    {
        $basecamp = Basecamp::findOrFail($id);
        $name = $basecamp->name;
        $basecamp->delete();

        \App\Models\AuditLog::record('DELETE', 'Menghapus Puskesmas: ' . $name);

        return redirect()->route('admin.basecamps.index')->with('success', 'Puskesmas berhasil dihapus.');
    }
}
