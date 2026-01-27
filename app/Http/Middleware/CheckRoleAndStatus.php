<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleAndStatus
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Belum login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Status tidak aktif
        if ($user->status !== 'active') {
            Auth::logout();

            return redirect()->route('login')
                ->withErrors(['email' => 'Akun Anda belum aktif atau diblokir.']);
        }

        // Role tidak diizinkan
        if (!empty($roles) && !in_array($user->role, $roles)) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
