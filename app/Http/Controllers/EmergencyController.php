<?php

namespace App\Http\Controllers;

use App\Models\EmergencyCall;
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
            'location' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // 2. Simpan ke Database
        EmergencyCall::create([
            'user_id' => Auth::id(), 
            'location' => $request->location,
            'description' => $request->description,
            'status' => 'pending', 
        ]);

        // 3. Kembalikan ke Dashboard dengan Pesan Sukses
        return redirect()->route('dashboard')->with('success', 'Panggilan Darurat terkirim! Ambulan sedang diproses.');
    }
}