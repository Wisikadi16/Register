<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\EmergencyCall;
use App\Models\User;
use App\Models\Hospital;
use App\Models\Basecamp;
use App\Models\Ambulance;

class DashboardController extends Controller
{
    public function masyarakat()
    {
        $activeCall = EmergencyCall::where('user_id', Auth::id())
            ->whereIn('status', ['pending', 'process'])
            ->latest()
            ->first();

        // Ambil 5 riwayat terakhir
        $history = EmergencyCall::where('user_id', Auth::id())
            ->latest()
            ->limit(5)
            ->get();

        return view('dashboard', compact('activeCall', 'history'));
    }

    public function lapangan()
    {
        $user = auth()->user();
        $ambulance = Ambulance::where('driver_id', $user->id)->first();
        $activeJob = null;

        if ($ambulance) {
            $activeJob = EmergencyCall::where('ambulance_id', $ambulance->id)
                ->whereIn('status', ['pending', 'process'])
                ->latest()->first();
        }
        $hospitals = Hospital::orderBy('available_bed_igd', 'desc')->get();

        return view('lapangan.dashboard', compact('ambulance', 'activeJob', 'hospitals'));
    }

    public function superAdmin()
    {
        $stats = [
            'total_users' => User::count(),
            'hospitals' => Hospital::count(),
            'total_basecamps' => Basecamp::count(),
            'total_ambulances' => Ambulance::count(),
            'total_drivers' => User::whereIn('role', ['driver', 'nakes'])->count(),
            'total_calls' => EmergencyCall::count(),
            'active_calls' => EmergencyCall::whereIn('status', ['pending', 'process'])->count(),
        ];
        // Pastikan view admin.dashboard bisa menerima variabel $stats
        return view('admin.dashboard', compact('stats'));
    }
}
