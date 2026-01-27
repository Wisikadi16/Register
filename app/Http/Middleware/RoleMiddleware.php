<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Ambil data user yang sedang login
        $user = $request->user();

        // 2. Cek apakah user ada & kolom 'role' sesuai dengan izin
        //    (Kita ganti 'usertype' menjadi 'role')
        if (! $user || ! in_array($user->role, $roles)) {
            
            // Jika role tidak cocok, kita tolak dengan Error 403 (Forbidden)
            // Ini akan memunculkan halaman "THIS ACTION IS UNAUTHORIZED"
            abort(403, 'Akses Ditolak. Role Anda (' . ($user->role ?? 'None') . ') tidak diizinkan masuk ke halaman ini.');
        }

        // 3. Jika cocok, silakan masuk
        return $next($request);
    }
}