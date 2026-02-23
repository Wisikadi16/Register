<?php

namespace App\Http\Controllers;

use App\Models\Referral;
use App\Models\Hospital;
use Illuminate\Http\Request;

class AdminReferralController extends Controller
{
    public function index()
    {
        $referrals = Referral::with(['originHospital', 'destinationHospital'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin-dinkes.referral.index', compact('referrals'));
    }

    public function update(Request $request, $id)
    {
        $referral = Referral::findOrFail($id);

        $request->validate([
            'status' => 'required|in:approved,rejected',
            'feedback_note' => 'nullable|string',
        ]);

        $referral->update([
            'status' => $request->status,
            'feedback_note' => $request->feedback_note,
        ]);

        return redirect()->back()->with('success', 'Status rujukan berhasil diperbarui.');
    }
}
