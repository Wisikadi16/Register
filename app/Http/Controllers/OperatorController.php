<?php

namespace App\Http\Controllers;

use App\Models\Ambulance;
use App\Models\DriverSchedule;
use App\Models\EmergencyCall;
use App\Models\Hospital;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    // 2A. FORM INPUT PASIEN MANUAL
    public function createPatient()
    {
        $ambulances = Ambulance::all();
        $hospitals = Hospital::orderBy('name')->get();
        return view('operator.reports.create', compact('ambulances', 'hospitals'));
    }

    // 2B. SIMPAN DATA PASIEN MANUAL (SINKRONISASI)
    public function storePatient(Request $request)
    {
        $request->validate([
            'patient_name' => 'required|string|max:255',
            'patient_age' => 'nullable|integer',
            'patient_condition' => 'nullable|string',
            'caller_name' => 'required|string|max:255',
            'caller_phone' => 'required|string|max:20',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'ambulance_id' => 'nullable|exists:ambulances,id',
            'hospital_id' => 'nullable|exists:hospitals,id',
        ]);

        $status = 'completed'; // Default manual input is usually already done

        EmergencyCall::create([
            'user_id' => Auth::id(), // Operator ID as the recorder
            'patient_name' => $request->patient_name,
            'patient_age' => $request->patient_age,
            'patient_condition' => $request->patient_condition,
            'caller_name' => $request->caller_name,
            'caller_phone' => $request->caller_phone,
            'location' => $request->location,
            'latitude' => -6.200000,  // Default mock lat
            'longitude' => 106.816666, // Default mock lng
            'description' => $request->description ?? 'Laporan Manual Operator',
            'ambulance_id' => $request->ambulance_id,
            'hospital_id' => $request->hospital_id,
            'status' => $status,
        ]);

        return redirect()->route('operator.reports.index')->with('success', 'Data pasien manual berhasil disinkronisasi ke sistem.');
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
