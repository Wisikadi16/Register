<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Ambulance;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminMaintenanceController extends Controller
{
    public function index()
    {
        $maintenances = Maintenance::with(['ambulance', 'inventory'])->orderBy('scheduled_date', 'asc')->get();
        $ambulances = Ambulance::all();
        $inventories = Inventory::all();

        return view('admin-dinkes.maintenance.index', compact('maintenances', 'ambulances', 'inventories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'scheduled_date' => 'required|date',
            'description' => 'required|string',
            'ambulance_id' => 'nullable|exists:ambulances,id',
            'inventory_id' => 'nullable|exists:inventories,id',
        ]);

        Maintenance::create($request->all());

        return redirect()->back()->with('success', 'Jadwal maintenance berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $maintenance = Maintenance::findOrFail($id);

        $request->validate([
            'status' => 'required|string',
            'cost' => 'nullable|numeric',
            'proof_image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['status', 'cost']);

        if ($request->hasFile('proof_image')) {
            // Delete old image if exists
            if ($maintenance->proof_image) {
                Storage::delete($maintenance->proof_image);
            }
            $data['proof_image'] = $request->file('proof_image')->store('maintenance_proofs', 'public');
        }

        $maintenance->update($data);

        return redirect()->back()->with('success', 'Status maintenance berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $maintenance = Maintenance::findOrFail($id);
        if ($maintenance->proof_image) {
            Storage::delete($maintenance->proof_image);
        }
        $maintenance->delete();
        return redirect()->back()->with('success', 'Data maintenance berhasil dihapus.');
    }
}
