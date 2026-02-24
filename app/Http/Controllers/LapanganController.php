<?php

namespace App\Http\Controllers;

use App\Models\Ambulance;
use App\Models\EmergencyCall;
use App\Models\Hospital;
use App\Models\MedicalRecord;
use App\Models\DriverAlert;
use App\Models\DisasterReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class LapanganController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. Cari ambulan yang driver_id-nya adalah ID user yang sedang login
        $ambulance = Ambulance::where('driver_id', $user->id)->first();

        $activeJob = null;
        if ($ambulance) {
            // 2. Cari panggilan SOS yang ditugaskan ke ambulan ini
            // Status: 'pending' (baru), 'dispatched' (dikirim), atau 'process' (sedang ditangani)
            $activeJob = EmergencyCall::where('ambulance_id', $ambulance->id)
                ->whereIn('status', ['pending', 'process', 'dispatched'])
                ->with('user') // Mengambil data masyarakat yang memanggil
                ->latest()
                ->first();
        }

        // 3. Ambil data Rumah Sakit untuk keperluan rujukan (disortir bed terbanyak)
        $hospitals = Hospital::orderBy('available_bed_igd', 'desc')->get();

        return view('lapangan.dashboard', compact('activeJob', 'hospitals', 'ambulance'));
    }

    /**
     * Menandakan tugas telah selesai.
     * Mengembalikan status ambulan menjadi 'ready'.
     */
    public function finishJob(Request $request, $id) // Tambahkan Request $request
    {
        // Validasi input nama petugas
        $request->validate([
            'driver_name' => 'required|string|max:255',
            'nakes_name' => 'nullable|string|max:255', // Nullable kalau misal berangkat tanpa nakes
        ]);

        $job = EmergencyCall::findOrFail($id);

        // Update status panggilan menjadi completed dan simpan nama petugas
        $job->update([
            'status' => 'completed',
            'driver_name' => $request->driver_name,
            'nakes_name' => $request->nakes_name ?? 'Tidak ada pendamping',
        ]);

        // Update status ambulan kembali menjadi ready agar bisa dipanggil lagi oleh sistem
        if ($job->ambulance_id) {
            Ambulance::where('id', $job->ambulance_id)->update(['status' => 'ready']);
        }

        return redirect()->route('lapangan.dashboard')->with('success', 'Tugas selesai! Laporan petugas jaga berhasil dicatat.');
    }
    public function storeMedicalRecord(Request $request)
    {
        $request->validate([
            'emergency_call_id' => 'required|exists:emergency_calls,id',
            'tensi' => 'nullable|string|max:20',
            'nadi' => 'nullable|integer|max:300',
            'suhu' => 'nullable|numeric|between:30,45',
            'nafas' => 'nullable|integer|max:100',
            'foto_kejadian' => 'nullable|image|max:5120', // Max 5MB
        ]);

        $data = $request->except(['foto_kejadian']);

        // Handle Upload Foto
        if ($request->hasFile('foto_kejadian')) {
            $data['foto_kejadian'] = $request->file('foto_kejadian')->store('medical_records', 'public');
        }

        MedicalRecord::create($data);

        return redirect()->back()->with('success', 'Data medis berhasil disimpan.');
    }
    public function panicButton(Request $request)
    {
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $user = Auth::user();
        $ambulance = Ambulance::where('driver_id', $user->id)->first();

        DriverAlert::create([
            'driver_id' => $user->id,
            'ambulance_id' => $ambulance ? $ambulance->id : null,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'status' => 'open',
        ]);

        return response()->json(['message' => 'Sinyal Bahaya Terkirim! Markas telah diberitahu.'], 200);
    }
    public function updateStatus(Request $request)
    {
        $user = Auth::user();
        $ambulance = Ambulance::where('driver_id', $user->id)->first();

        if ($ambulance) {
            $newStatus = $request->status == 'ready' ? 'ready' : 'offline';
            $ambulance->update(['status' => $newStatus]);

            return redirect()->back()->with('success', 'Status Anda sekarang: ' . strtoupper($newStatus));
        }

        return redirect()->back()->with('error', 'Ambulan tidak ditemukan.');
    }

    public function storeDisasterReport(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'photo_proof' => 'required|image|max:10240', // Max 10MB
            'casualties_light' => 'nullable|integer|min:0',
            'casualties_heavy' => 'nullable|integer|min:0',
            'casualties_deceased' => 'nullable|integer|min:0',
            'casualties_missing' => 'nullable|integer|min:0',
        ]);

        $data = $request->except(['photo_proof', 'latitude', 'longitude']);
        $data['user_id'] = Auth::id();

        // Handle Coordinates if available
        if ($request->filled('latitude'))
            $data['latitude'] = $request->latitude;
        if ($request->filled('longitude'))
            $data['longitude'] = $request->longitude;

        // Handle Upload Foto
        if ($request->hasFile('photo_proof')) {
            $data['photo_proof'] = $request->file('photo_proof')->store('disaster_reports', 'public');
        }

        DisasterReport::create($data);

        return redirect()->back()->with('success', 'Laporan Bencana (RHA) berhasil dikirim!');
    }
    public function scheduleIndex()
    {
        // Ambil jadwal milik user yang sedang login
        $schedules = \App\Models\DriverSchedule::where('user_id', Auth::id())
            ->orderBy('date', 'desc')
            ->get();

        return view('lapangan.schedules.index', compact('schedules'));
    }

    public function scheduleStore(Request $request)
    {
        // Validasi & Simpan Jadwal (Self-Service)
        $request->validate([
            'date' => 'required|date',
            'shift' => 'required|in:pagi,siang,malam',
        ]);

        \App\Models\DriverSchedule::create([
            'user_id' => Auth::id(),
            'date' => $request->date,
            'shift' => $request->shift,
            'notes' => $request->notes
        ]);

        return redirect()->back()->with('success', 'Jadwal berhasil diajukan.');
    }
    public function messagesIndex()
    {
        $messages = \App\Models\Message::where('receiver_id', Auth::id())
            ->with('sender')
            ->latest()
            ->get();

        return view('lapangan.messages.index', compact('messages'));
    }

    public function sterilizationCreate()
    {
        return view('lapangan.sterilizations.create');
    }

    public function sterilizationStore(Request $request)
    {
        $request->validate([
            'method' => 'required',
            'photo_proof' => 'required|image'
        ]);

        $path = $request->file('photo_proof')->store('sterilizations', 'public');

        $ambulance = \App\Models\Ambulance::where('driver_id', Auth::id())->firstOrFail();

        \App\Models\AmbulanceSterilization::create([
            'ambulance_id' => $ambulance->id,
            'user_id' => Auth::id(),
            'date' => now(),
            'method' => $request->method,
            'notes' => $request->notes,
            'photo_proof' => $path
        ]);

        return redirect()->route('lapangan.dashboard')->with('success', 'Laporan Sterilisasi Terkirim.');
    }

    public function performanceIndex()
    {
        // Hitung stat sederhana
        $totalCalls = \App\Models\EmergencyCall::where('ambulance_id', function ($q) {
            $q->select('id')->from('ambulances')->where('driver_id', Auth::id());
        })->where('status', 'completed')->count();

        return view('lapangan.performance.index', compact('totalCalls'));
    }


}