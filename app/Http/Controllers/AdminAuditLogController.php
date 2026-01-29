<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;

class AdminAuditLogController extends Controller
{
    // Menampilkan daftar Log Aktivitas
    public function index()
    {
        // Urutkan dari yang terbaru, paginate 20 item
        $logs = AuditLog::with('user')->latest()->paginate(20);
        return view('admin.logs.index', compact('logs'));
    }
}
