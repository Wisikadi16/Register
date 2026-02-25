<?php

namespace App\Http\Controllers;

use App\Models\FacilityRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FacilityRequestController extends Controller
{
    // ==========================================
    // BAGIAN FASKES (PUSKESMAS/RS)
    // ==========================================
    public function faskesIndex()
    {
        $requests = FacilityRequest::where('user_id', Auth::id())->latest()->get();
        return view('faskes.requests.index', compact('requests'));
    }

    public function faskesStore(Request $request)
    {
        $request->validate([
            'category' => 'required|string',
            'description' => 'required|string',
            'photo_proof' => 'nullable|image|max:5120',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo_proof')) {
            $photoPath = $request->file('photo_proof')->store('facility_requests', 'public');
        }

        FacilityRequest::create([
            'user_id' => Auth::id(),
            'category' => $request->category,
            'description' => $request->description,
            'photo_proof' => $photoPath,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Laporan/Permintaan berhasil dikirim ke Operator Pusat.');
    }

    // ==========================================
    // BAGIAN OPERATOR PUSAT
    // ==========================================
    public function operatorIndex()
    {
        // Tarik semua laporan dari semua faskes
        $requests = FacilityRequest::with('user', 'operator')->latest()->get();
        return view('operator.requests.index', compact('requests'));
    }

    public function operatorUpdate(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:process,completed,rejected',
            'operator_notes' => 'nullable|string',
        ]);

        $facilityRequest = FacilityRequest::findOrFail($id);

        $facilityRequest->update([
            'status' => $request->status,
            'operator_notes' => $request->operator_notes,
            'operator_id' => Auth::id(), // Catat operator siapa yang bales
        ]);

        return redirect()->back()->with('success', 'Tiket laporan berhasil diupdate & dibalas!');
    }
}