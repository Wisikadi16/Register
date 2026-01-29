<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminNotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::with('sender')
            ->select('id', 'title', 'message', 'target_role', 'sent_by', 'created_at')
            ->distinct()
            ->groupBy('title', 'message', 'target_role', 'sent_by', 'id', 'created_at')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.notifications.index', compact('notifications'));
    }

    public function create()
    {
        return view('admin.notifications.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'target_role' => 'nullable|string',
        ]);

        // Tentukan target users
        if ($request->target_role == 'all' || !$request->target_role) {
            $targetUsers = User::all();
        } else {
            $targetUsers = User::where('role', $request->target_role)->get();
        }

        // Kirim notifikasi ke setiap user
        foreach ($targetUsers as $user) {
            Notification::create([
                'title' => $request->title,
                'message' => $request->message,
                'target_role' => $request->target_role,
                'sent_by' => Auth::id(),
                'user_id' => $user->id,
                'is_read' => false,
            ]);
        }

        AuditLog::record('Broadcast Notification', "Mengirim broadcast: {$request->title} ke " . ($request->target_role ?? 'semua user'));

        return redirect()->route('admin.notifications.index')
            ->with('success', 'Notifikasi berhasil dikirim ke ' . $targetUsers->count() . ' pengguna!');
    }

    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }
}
