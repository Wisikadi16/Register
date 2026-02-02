<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <--- Jangan lupa ini
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();

        // 1. Cek apakah user login?
        if (!$user) {
            return redirect()->route('login');
        }

        // 2. CEK STATUS (Fitur Tambahan Penting)
        // Jika status inactive, tendang keluar.
        if (isset($user->status) && $user->status !== 'active') {
            Auth::logout();
            return redirect()->route('login')
                ->withErrors(['email' => 'Akun Anda dinonaktifkan / belum aktif.']);
        }

        // 3. CEK ROLE
        // Pastikan kolom 'role' sesuai dengan yang diizinkan
        $userRole = strtolower($user->role);
        $allowedRoles = array_map(fn($role) => strtolower(trim($role)), $roles);

        if (!in_array($userRole, $allowedRoles)) {
            abort(403, 'Akses Ditolak. Role Anda (' . $user->role . ') tidak diizinkan masuk.');
        }

        return $next($request);
    }
}