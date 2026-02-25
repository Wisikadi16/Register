<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Global Notifications View Composer
        \Illuminate\Support\Facades\View::composer('components.floating-notifications', function ($view) {
            $notifications = [];
            $unreadCount = 0;

            if (\Illuminate\Support\Facades\Auth::check()) {
                $user = \Illuminate\Support\Facades\Auth::user();

                if (in_array($user->role, ['operator', 'admin', 'super_admin'])) {
                    // Operator sees pending emergency calls and pending feature requests
                    $emCalls = \App\Models\EmergencyCall::where('status', 'pending')
                        ->orderBy('created_at', 'desc')
                        ->take(5)
                        ->get();

                    foreach ($emCalls as $call) {
                        $notifications[] = [
                            'id' => $call->id,
                            'type' => 'emergency',
                            'title' => 'Panggilan Darurat Baru',
                            'message' => 'Dari: ' . ($call->user ? $call->user->name : 'Anonim') . ' - ' . ($call->type == 'phone_call' ? 'Permintaan Telepon' : 'Ambulan'),
                            'time' => $call->created_at->diffForHumans(),
                            'is_unread' => !$call->is_read_by_operator, // Check the new column
                            'url' => route('operator.dashboard'),
                            'icon' => $call->type == 'phone_call' ? 'fas fa-phone-volume' : 'fas fa-ambulance',
                            'created_at' => $call->created_at
                        ];
                        if (!$call->is_read_by_operator)
                            $unreadCount++;
                    }

                    $facReqs = \App\Models\FacilityRequest::where('status', 'pending')
                        ->orderBy('created_at', 'desc')
                        ->take(5)
                        ->get();

                    foreach ($facReqs as $req) {
                        $notifications[] = [
                            'id' => $req->id,
                            'type' => 'ticket',
                            'title' => 'Tiket Faskes Baru',
                            'message' => $req->category . ' dari ' . ($req->user ? $req->user->name : 'Faskes'),
                            'time' => $req->created_at->diffForHumans(),
                            'is_unread' => !$req->is_read_by_operator,
                            'url' => route('operator.requests.index'),
                            'icon' => 'fas fa-ticket-alt',
                            'created_at' => $req->created_at
                        ];
                        if (!$req->is_read_by_operator)
                            $unreadCount++;
                    }
                } elseif (in_array($user->role, ['rumahsakit', 'klinik_utama', 'puskesmas', 'lab_medik'])) {
                    // Faskes sees updates to their own tickets (not pending)
                    $facReqs = \App\Models\FacilityRequest::where('user_id', $user->id)
                        ->where('status', '!=', 'pending')
                        ->orderBy('updated_at', 'desc')
                        ->take(5)
                        ->get();

                    foreach ($facReqs as $req) {
                        $isRecent = $req->updated_at > now()->subDays(1);
                        // For Faskes, unread if not yet read by user
                        $is_unread = !$req->is_read_by_user;

                        $notifications[] = [
                            'id' => $req->id,
                            'type' => 'ticket_reply',
                            'title' => 'Update Tiket: ' . ucfirst($req->status),
                            'message' => $req->operator_notes ? 'Catatan: ' . $req->operator_notes : 'Tiket Anda sedang diproses.',
                            'time' => $req->updated_at->diffForHumans(),
                            'is_unread' => $is_unread,
                            'url' => route(in_array($user->role, ['puskesmas', 'lab_medik']) ? 'puskesmas.requests.index' : 'faskes.requests.index'),
                            'icon' => 'fas fa-reply',
                            'created_at' => $req->updated_at
                        ];
                        if ($is_unread)
                            $unreadCount++;
                    }
                }
            }

            // Sort combining both collections by date descending
            usort($notifications, function ($a, $b) {
                return $b['created_at'] <=> $a['created_at'];
            });

            // Keep only top 5 total
            $globalNotifications = array_slice($notifications, 0, 5);

            $view->with(compact('globalNotifications', 'unreadCount'));
        });
    }
}
