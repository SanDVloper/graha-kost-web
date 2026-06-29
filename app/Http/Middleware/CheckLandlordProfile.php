<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckLandlordProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Hanya cek jika yang login adalah landlord (tuan_kos)
        if (Auth::check() && Auth::user()->role === 'tuan_kos') {
            $user = Auth::user();

            // Cek apakah ada profil yang belum lengkap (termasuk rekening bank)
            if (empty($user->phone_number) || empty($user->gender) || empty($user->pekerjaan) ||
                empty($user->bank_name) || empty($user->bank_account_number) || empty($user->bank_account_name)) {
                
                // Jika sedang mengakses route logout atau form POST profil, biarkan
                if ($request->routeIs('landlord.profile.store') || $request->routeIs('logout')) {
                    return $next($request);
                }

                // Redirect ke dashboard (di mana form profil akan terintegrasi dengan UI)
                return redirect()->route('landlord.dashboard')
                                 ->with('warning', 'Mohon lengkapi profil Anda terlebih dahulu sebelum mengelola properti kos.');
            }
        }

        return $next($request);
    }
}
