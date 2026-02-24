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
                            'id' => 'em_' . $call->id,
                            'type' => 'emergency',
                            'title' => 'Panggilan Darurat Baru',
                            'message' => 'Dari: ' . ($call->user ? $call->user->name : 'Anonim') . ' - ' . ($call->type == 'phone_call' ? 'Permintaan Telepon' : 'Ambulan'),
                            'time' => $call->created_at->diffForHumans(),
                            'is_unread' => true, // Pending calls are unread for operators
                            'url' => route('operator.dashboard'),
                            'icon' => $call->type == 'phone_call' ? 'fas fa-phone-volume' : 'fas fa-ambulance',
                            'created_at' => $call->created_at
                        ];
                        $unreadCount++;
                    }

                    $facReqs = \App\Models\FacilityRequest::where('status', 'pending')
                        ->orderBy('created_at', 'desc')
                        ->take(5)
                        ->get();

                    foreach ($facReqs as $req) {
                        $notifications[] = [
                            'id' => 'req_' . $req->id,
                            'type' => 'ticket',
                            'title' => 'Tiket Faskes Baru',
                            'message' => $req->category . ' dari ' . ($req->user ? $req->user->name : 'Faskes'),
                            'time' => $req->created_at->diffForHumans(),
                            'is_unread' => true,
                            'url' => route('operator.requests.index'),
                            'icon' => 'fas fa-ticket-alt',
                            'created_at' => $req->created_at
                        ];
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
                        // Let's assume ANY update is "unread" for simplicity unless they click it,
                        // but since we don't have a read tracking table, we'll just show the latest 5.
                        // We'll highlight them as unread if they were updated in the last 24 hours.
                        $isRecent = $req->updated_at > now()->subDays(1);
                        $notifications[] = [
                            'id' => 'req_' . $req->id,
                            'type' => 'ticket_reply',
                            'title' => 'Update Tiket: ' . ucfirst($req->status),
                            'message' => $req->operator_notes ? 'Catatan: ' . $req->operator_notes : 'Tiket Anda sedang diproses.',
                            'time' => $req->updated_at->diffForHumans(),
                            'is_unread' => $isRecent,
                            'url' => route(in_array($user->role, ['puskesmas', 'lab_medik']) ? 'puskesmas.requests.index' : 'faskes.requests.index'),
                            'icon' => 'fas fa-reply',
                            'created_at' => $req->updated_at
                        ];
                        if ($isRecent)
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
