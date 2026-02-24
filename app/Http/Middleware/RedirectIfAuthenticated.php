<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {

                $user = Auth::user();
                $role = $user->role;

                // Group admin
                if ($role === 'super_admin') {
                    return redirect()->route('super-admin.dashboard');
                }

                if (in_array($role, ['admin', 'ka', 'sie_rujukan'])) {
                    return redirect()->route('admin.dashboard');
                }

                if ($role === 'atem') {
                    return redirect()->route('atem.dashboard');
                }

                // Group operator
                if (in_array($role, ['operator'])) {
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
                if (in_array($role, ['rumahsakit', 'klinik_utama'])) {
                    return redirect()->route('faskes.dashboard');
                }

                // Group Lab Puskesmas
                if (in_array($role, ['puskesmas', 'lab_medik'])) {
                    return redirect()->route('puskesmas.dashboard');
                }

                if ($role === 'masyarakat') {
                    return redirect()->route('dashboard');
                }

                return redirect('/dashboard');
            }
        }

        return $next($request);
    }
}
