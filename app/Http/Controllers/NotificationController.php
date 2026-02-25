<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAsRead(Request $request)
    {
        $id = $request->id;
        $type = $request->type; // 'emergency', 'ticket', 'ticket_reply'

        if ($type === 'emergency') {
            $call = \App\Models\EmergencyCall::find($id);
            if ($call) {
                $call->update(['is_read_by_operator' => true]);
            }
        } elseif (in_array($type, ['ticket', 'ticket_reply'])) {
            $req = \App\Models\FacilityRequest::find($id);
            if ($req) {
                $user = \Illuminate\Support\Facades\Auth::user();
                if ($user && in_array($user->role, ['operator', 'admin', 'super_admin'])) {
                    $req->update(['is_read_by_operator' => true]);
                } else {
                    $req->update(['is_read_by_user' => true]);
                }
            }
        }

        return response()->json(['success' => true]);
    }
}
