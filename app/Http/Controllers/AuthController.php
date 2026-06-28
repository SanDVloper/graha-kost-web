<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:pencari,tuan_kos',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role, // Akan masuk sebagai 'pencari' or 'tuan_kos'
        ]);

        Auth::login($user);

        if ($user->role === 'tuan_kos') {
            return redirect()->route('landlord.dashboard')->with('success', 'Pendaftaran berhasil! Selamat datang Pemilik Kos.');
        } else {
            return redirect()->route('customer.index')->with('success', 'Berhasil mendaftar! Silakan cari kos impianmu.');
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $role = auth()->user()->role;

            if ($role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            elseif ($role === 'tuan_kos') {
                return redirect()->route('landlord.dashboard');
            }
            // 🟢 PERBAIKAN UTAMA: Begitu akun ber-role 'penghuni' sukses login, langsung lempar ke rute /kos-saya privatnya
            elseif ($role === 'penghuni') {
                return redirect()->route('customer.myKos')->with('success', 'Selamat datang kembali di hunian kos Anda!');
            }
            else {
                // Pencari diarahkan ke halaman cari kos biasa
                return redirect()->intended(route('customer.index'))->with('success', 'Selamat datang kembali!');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function globalSettings()
    {
        $role = auth()->user()->role;

        if ($role === 'tuan_kos') {
            return view('landlord.global-settings');
        }
        return abort(404, 'Halaman pengaturan untuk role ini belum dibuat.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
