<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    public function index()
    {
        $hospitals = Hospital::all();
        return view('faskes.dashboard', compact('hospitals'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'available_bed_igd' => 'required|integer',
            'available_bed_icu' => 'required|integer',
        ]);
        $hospital = Hospital::findOrFail($id);
        $hospital->update([
            'available_bed_igd' => $request->available_bed_igd,
            'available_bed_icu' => $request->available_bed_icu,
        ]);
        return redirect()->back()->with('success', 'Data keterseidaan kamar Rumah Sakit berhasil diperbarui.');
    }
}
