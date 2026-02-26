<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LabPatient;
use Illuminate\Support\Facades\Auth;

class LabMedikController extends Controller
{
    public function dashboard()
    {
        $patients = LabPatient::where('lab_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('lab-medik.dashboard', compact('patients'));
    }

    public function create()
    {
        return view('lab-medik.patients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'nullable|string|max:20',
            'age' => 'required|integer|min:0',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'address' => 'nullable|string',
            'test_type' => 'required|string',
            'result' => 'nullable|string',
        ]);

        LabPatient::create([
            'lab_id' => Auth::id(),
            'name' => $request->name,
            'nik' => $request->nik,
            'age' => $request->age,
            'gender' => $request->gender,
            'address' => $request->address,
            'test_type' => $request->test_type,
            'result' => $request->result,
        ]);

        return redirect()->route('lab-medik.dashboard')->with('success', 'Data Pasien Lab berhasil disimpan!');
    }
}
