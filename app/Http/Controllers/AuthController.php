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

        if ($role === 'admin') {
            return view('admin.settings');
        } elseif ($role === 'tuan_kos') {
            return view('landlord.global-settings');
        } else {
            return view('customer.settings');
        }
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'gender' => 'nullable|in:L,P',
            'pekerjaan' => 'nullable|string|max:255',
            'bank_name' => 'nullable|string|max:100',
            'bank_account_number' => 'nullable|string|max:100',
            'bank_account_name' => 'nullable|string|max:255',
        ]);

        $user = auth()->user();
        $user->name = $request->name;
        
        if ($request->has('phone_number')) {
            $user->phone_number = $request->phone_number;
        }
        if ($request->has('gender')) {
            $user->gender = $request->gender;
        }
        if ($request->has('pekerjaan')) {
            $user->pekerjaan = $request->pekerjaan;
        }
        if ($request->has('bank_name')) {
            $user->bank_name = $request->bank_name;
        }
        if ($request->has('bank_account_number')) {
            $user->bank_account_number = $request->bank_account_number;
        }
        if ($request->has('bank_account_name')) {
            $user->bank_account_name = $request->bank_account_name;
        }
        
        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = auth()->user();

        if (!\Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah.']);
        }

        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Password berhasil diperbarui!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
    public function completeProfileView()
    {
        // Hanya untuk landlord (tuan_kos)
        if (auth()->user()->role !== 'tuan_kos') {
            return redirect('/');
        }

        return view('landlord.complete-profile');
    }

    public function completeProfileStore(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|string|max:20',
            'gender'       => 'required|in:Laki-laki,Perempuan',
            'pekerjaan'    => 'required|string|max:255',
            'bank_name'    => 'required|string|max:255',
            'bank_account_number' => 'required|string|max:255',
            'bank_account_name'   => 'required|string|max:255',
        ]);

        $user = auth()->user();
        $user->phone_number = $request->phone_number;
        $user->gender = $request->gender;
        $user->pekerjaan = $request->pekerjaan;
        $user->bank_name = $request->bank_name;
        $user->bank_account_number = $request->bank_account_number;
        $user->bank_account_name = $request->bank_account_name;
        $user->save();

        return redirect()->route('landlord.dashboard')->with('success', 'Profil berhasil dilengkapi! Anda sekarang dapat menambahkan properti.');
    }
}
