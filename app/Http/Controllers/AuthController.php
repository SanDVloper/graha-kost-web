<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // Menampilkan halaman login/register
    public function showLogin()
    {
        return view('login');
    }

    // Memproses Pendaftaran (Register)
    public function register(Request $request)
    {
        // Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // Harus cocok dengan password_confirmation
            'role' => 'required|in:pencari,tuan_kos',
        ]);

        // Simpan ke database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Enkripsi password
            'role' => $request->role,
        ]);

        // Otomatis login setelah daftar
        Auth::login($user);

        return redirect('/')->with('success', 'Pendaftaran berhasil! Selamat datang di GRAHA.');
    }

    // Memproses Masuk (Login)
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            // Arahkan berdasarkan role jika diperlukan (saat ini semua ke dashboard)
            return redirect()->intended('/')->with('success', 'Berhasil masuk.');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    // Menampilkan halaman Pengaturan Akun Global
    public function globalSettings()
    {
        return view('global-settings');
    }

    // Memproses Keluar (Logout)
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

}