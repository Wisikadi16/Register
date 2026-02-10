<?php

namespace App\Http\Controllers;

use App\Models\EmergencyCall;
use App\Models\Ambulance;
use App\Models\Hospital;
use App\Models\Basecamp;
use App\Models\Inventory;
use App\Models\Logistic;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDinkesController extends Controller
{
    public function dashboard()
    {
        // Statistik Operasional untuk Admin Dinas Kesehatan
        $stats = [
            'total_calls_today' => EmergencyCall::whereDate('created_at', today())->count(),
            'total_calls' => EmergencyCall::count(),
            'active_ambulances' => Ambulance::where('status', 'on_duty')->count(),
            'available_ambulances' => Ambulance::where('status', 'available')->count(),
            'total_hospitals' => Hospital::count(),
            'total_basecamps' => Basecamp::count(),
        ];

        // Kejadian Darurat Terbaru (5 terakhir)
        $recentCalls = EmergencyCall::with(['user', 'ambulance'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Data untuk Chart: Kejadian per hari (7 hari terakhir)
        $chartData = EmergencyCall::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('count(*) as total')
        )
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        return view('admin-dinkes.dashboard', compact('stats', 'recentCalls', 'chartData'));
    }

    // Monitoring Kejadian (Emergency Calls / Laporan)
    public function reports(Request $request)
    {
        $query = EmergencyCall::with(['user', 'ambulance', 'hospital']);

        // Filter based on date if provided
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        $calls = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin-dinkes.reports', compact('calls'));
    }

    // Monitoring Armada (Ambulances)
    public function ambulances()
    {
        $ambulances = Ambulance::with('basecamp')->get();
        return view('admin-dinkes.ambulances', compact('ambulances'));
    }

    // Monitoring RS (Beds Availability)
    public function hospitals()
    {
        $hospitals = Hospital::all();
        return view('admin-dinkes.hospitals', compact('hospitals'));
    }

    // --- MODUL INVENTORI (Sesuai Use Case) ---
    public function inventoryIndex()
    {
        $inventories = Inventory::orderBy('category')->get();
        return view('admin-dinkes.inventory.index', compact('inventories'));
    }

    public function inventoryStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'category' => 'required|string',
            'quantity' => 'required|integer',
            'unit' => 'nullable|string',
        ]);

        // Auto-set status based on quantity
        $status = 'available';
        if ($request->quantity == 0) {
            $status = 'out_of_stock';
        } elseif ($request->quantity <= 10) {
            $status = 'low_stock';
        }

        Inventory::create([
            'name' => $request->name,
            'category' => $request->category,
            'quantity' => $request->quantity,
            'unit' => $request->unit,
            'status' => $status,
        ]);

        return redirect()->back()->with('success', 'Data inventori berhasil ditambahkan.');
    }

    public function inventoryEdit($id)
    {
        $inventory = Inventory::findOrFail($id);
        return view('admin-dinkes.inventory.edit', compact('inventory'));
    }

    public function inventoryUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'category' => 'required|string',
            'quantity' => 'required|integer',
            'unit' => 'nullable|string',
        ]);

        $inventory = Inventory::findOrFail($id);

        // Auto-set status based on quantity
        $status = 'available';
        if ($request->quantity == 0) {
            $status = 'out_of_stock';
        } elseif ($request->quantity <= 10) {
            $status = 'low_stock';
        }

        $inventory->update([
            'name' => $request->name,
            'category' => $request->category,
            'quantity' => $request->quantity,
            'unit' => $request->unit,
            'status' => $status,
        ]);

        return redirect()->route('admin.dinkes.inventory.index')->with('success', 'Data inventori berhasil diperbarui.');
    }

    public function inventoryDestroy($id)
    {
        $inventory = Inventory::findOrFail($id);
        $inventory->delete();
        return redirect()->back()->with('success', 'Data inventori berhasil dihapus.');
    }

    // --- MODUL LOGISTIK (Service & BBM) ---
    public function logisticIndex()
    {
        $logistics = Logistic::with('ambulance')->orderBy('request_date', 'desc')->get();
        $ambulances = Ambulance::all();
        return view('admin-dinkes.logistics.index', compact('logistics', 'ambulances'));
    }

    public function logisticStore(Request $request)
    {
        $request->validate([
            'ambulance_id' => 'required|exists:ambulances,id',
            'type' => 'required|string',
            'amount' => 'required|numeric',
            'request_date' => 'required|date',
        ]);

        Logistic::create($request->all());
        return redirect()->back()->with('success', 'Pengajuan logistik berhasil disimpan.');
    }

    public function logisticEdit($id)
    {
        $logistic = Logistic::findOrFail($id);
        $ambulances = Ambulance::all();
        return view('admin-dinkes.logistics.edit', compact('logistic', 'ambulances'));
    }

    public function logisticUpdate(Request $request, $id)
    {
        $request->validate([
            'ambulance_id' => 'required|exists:ambulances,id',
            'type' => 'required|string',
            'amount' => 'required|numeric',
            'request_date' => 'required|date',
            'status' => 'required|string|in:pending,approved,completed',
        ]);

        $logistic = Logistic::findOrFail($id);
        $logistic->update($request->all());
        return redirect()->route('admin.dinkes.logistics.index')->with('success', 'Data logistik berhasil diperbarui.');
    }

    public function logisticMarkAsCompleted($id)
    {
        $logistic = Logistic::findOrFail($id);
        $logistic->update(['status' => 'completed']);
        return redirect()->back()->with('success', 'Status logistik berhasil diperbarui menjadi Selesai.');
    }

    public function logisticDestroy($id)
    {
        $logistic = Logistic::findOrFail($id);
        $logistic->delete();
        return redirect()->back()->with('success', 'Data logistik berhasil dihapus.');
    }

    // --- MODUL UTILITAS (Listrik & PAM) ---
    public function utilityIndex()
    {
        $utilities = Utility::orderBy('billing_period', 'desc')->get();
        return view('admin-dinkes.utilities.index', compact('utilities'));
    }

    public function utilityStore(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'amount' => 'required|numeric',
            'billing_period' => 'required|string',
        ]);

        Utility::create($request->all());
        return redirect()->back()->with('success', 'Data utilitas berhasil disimpan.');
    }

    public function utilityEdit($id)
    {
        $utility = Utility::findOrFail($id);
        return view('admin-dinkes.utilities.edit', compact('utility'));
    }

    public function utilityUpdate(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|string',
            'amount' => 'required|numeric',
            'billing_period' => 'required|string',
            'status' => 'required|string|in:unpaid,paid',
        ]);

        $utility = Utility::findOrFail($id);
        $utility->update($request->all());
        return redirect()->route('admin.dinkes.utilities.index')->with('success', 'Data utilitas berhasil diperbarui.');
    }

    public function utilityMarkAsPaid($id)
    {
        $utility = Utility::findOrFail($id);
        $utility->update(['status' => 'paid']);
        return redirect()->back()->with('success', 'Tagihan berhasil ditandai LUNAS.');
    }

    public function utilityDestroy($id)
    {
        $utility = Utility::findOrFail($id);
        $utility->delete();
        return redirect()->back()->with('success', 'Data utilitas berhasil dihapus.');
    }

    // --- REKAP PASIEN AH ---
    public function patientRecap()
    {
        // Rekap Pasien berdasarkan Emergency Call yang 'completed'
        $recap = EmergencyCall::with(['user', 'ambulance', 'hospital'])
            ->where('status', 'completed')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin-dinkes.reports.patient-recap', compact('recap'));
    }
}
