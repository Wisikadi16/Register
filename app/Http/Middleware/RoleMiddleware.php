<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    // Perhatikan tanda titik tiga (...$roles) untuk menangkap banyak role
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Ambil usertype dari user yang sedang login
        $userRole = $request->user()->usertype;

        // Cek: Apakah role user ada di dalam daftar yang diizinkan?
        // Contoh: Apakah 'super_admin' ada di daftar ['admin', 'super_admin']?
        if (in_array($userRole, $roles)) {
            return $next($request); // SILAKAN MASUK
        }

        // --- JIKA DITOLAK, LEMPAR SESUAI JABATAN ASLINYA ---
        
        if ($userRole === 'admin' || $userRole === 'super_admin') {
            return redirect()->route('admin.dashboard');
        }
        
        if ($userRole === 'ambulan') {
            return redirect()->route('ambulan.dashboard');
        }

        // Default lempar ke halaman masyarakat
        return redirect()->route('dashboard');
    }
}