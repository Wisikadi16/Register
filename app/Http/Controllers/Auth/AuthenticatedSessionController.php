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
            return redirect()->intended(route('super-admin.dashboard', absolute: false));
        }

        if (in_array($role, ['admin', 'ka', 'sie_rujukan', 'atem'])) {
            return redirect()->intended(route('admin.dashboard', absolute: false));
        }

        // Group operator
        if (in_array($role, ['operator'])) {
            return redirect()->intended(route('operator.dashboard', absolute: false));
        }

        // Group lapangan
        if (in_array($role, ['driver', 'nakes', 'peserta_bhd'])) {
            return redirect()->intended(route('lapangan.dashboard', absolute: false));
        }

        // Group faskes
        if (in_array($role, ['rumahsakit', 'klinik_utama', 'puskesmas', 'lab_medik'])) {
            return redirect()->intended(route('faskes.dashboard', absolute: false));
        }
        if ($role === 'masyarakat') {
            return redirect()->intended(route('dashboard', false));
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
