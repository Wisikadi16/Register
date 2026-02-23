<?php

namespace App\Http\Controllers;

use App\Models\Ambulance;
use App\Models\DriverSchedule;
use App\Models\EmergencyCall;
use App\Models\Hospital;
use App\Models\User;
use Illuminate\Http\Request;

class OperatorController extends Controller
{
    // DASHBOARD UTAMA
    public function dashboard()
    {
        $emergencies = EmergencyCall::with(['user', 'ambulance', 'hospital'])
            ->orderBy('created_at', 'desc')->get();

        $ambulances = Ambulance::all();
        $hospitals = Hospital::orderBy('name')->get();

        return view('operator.dashboard', compact('emergencies', 'ambulances', 'hospitals'));
    }

    // 1. INPUT JADWAL DRIVER
    public function scheduleIndex()
    {
        $schedules = DriverSchedule::with('user')
            ->orderBy('date', 'desc')
            ->get();

        $drivers = User::where('role', 'driver')->get();

        return view('operator.schedules.index', compact('schedules', 'drivers'));
    }

    public function scheduleStore(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'shift' => 'required|in:pagi,siang,malam',
        ]);

        DriverSchedule::create($request->all());

        return redirect()->back()->with('success', 'Jadwal berhasil ditambahkan.');
    }

    // 2. REKAP LAPORAN PASIEN
    public function reports()
    {
        // Menampilkan histori panggilan yang completed
        $reports = EmergencyCall::where('status', 'completed')
            ->with(['user', 'ambulance', 'hospital'])
            ->latest()
            ->paginate(10);

        return view('operator.reports.index', compact('reports'));
    }

    // 3. AMBULAN SWASTA / MASYARAKAT
    public function privateAmbulances()
    {
        $ambulances = Ambulance::whereIn('type', ['swasta', 'masyarakat'])->get();
        return view('operator.ambulances.private', compact('ambulances'));
    }

    // 4. HUBUNGI DRIVER
    public function contacts()
    {
        $drivers = User::whereIn('role', ['driver', 'nakes'])
            ->where('status', 'active')
            ->get();

        return view('operator.contacts.index', compact('drivers'));
    }
}
