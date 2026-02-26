<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Autentikasi (email + password)
        $request->authenticate();
        $request->session()->regenerate();

        $user = $request->user();

        // 🔴 VALIDASI STATUS USER (WAJIB SESUAI FLOW & KAK)
        if ($user->status !== 'active') {
            Auth::logout();

            return back()->withErrors([
                'email' => 'Akun Anda belum aktif atau diblokir.',
            ]);
        }

        $role = $user->role;

        // Group admin
        if ($role === 'super_admin') {
            return redirect()->route('super-admin.dashboard');
        }

        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($role === 'ka') {
            return redirect()->route('ka.dashboard');
        }

        if ($role === 'atem') {
            return redirect()->route('atem.dashboard');
        }

        // Group operator
        if ($role === 'operator') {
            return redirect()->route('operator.dashboard');
        }

        // Group lapangan
        if (in_array($role, ['driver', 'peserta_bhd'])) {
            return redirect()->route('lapangan.dashboard');
        }

        if ($role === 'nakes') {
            return redirect()->route('nakes.dashboard');
        }
        if ($role === 'sie_rujukan') {
            return redirect()->route('sie.dashboard');
        }

        // Group faskes
        if ($role === 'rumahsakit') {
            return redirect()->route('faskes.dashboard');
        }

        if ($role === 'klinik_utama') {
            return redirect()->route('klinik.dashboard');
        }

        // Group Lab Puskesmas
        if ($role === 'puskesmas') {
            return redirect()->route('puskesmas.dashboard');
        }

        if ($role === 'lab_medik') {
            return redirect()->route('lab-medik.dashboard');
        }
        if ($role === 'masyarakat') {
            return redirect()->route('dashboard');
        }



        // 🔴 ROLE TIDAK TERDAFTAR → TOLAK AKSES
        Auth::logout();

        return back()->withErrors([
            'email' => 'Role pengguna tidak dikenali oleh sistem.',
        ]);
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
