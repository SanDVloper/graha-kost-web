@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="container mx-auto px-6 max-w-4xl space-y-8">

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-[#1E3A8A] flex items-center">
                <i class="fa-solid fa-user-gear mr-3 text-blue-500"></i> Pengaturan Akun
            </h1>
            <p class="text-gray-500 mt-1">Kelola data profil dan keamanan akun Anda.</p>
        </div>

        @if(session('success'))
            <div class="bg-teal-100 border border-teal-400 text-teal-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Profile Section -->
        <div class="bg-white rounded-xl border border-gray-200 p-8 shadow-sm">
            <h3 class="text-lg font-bold text-[#1e3a5f] mb-6 flex items-center border-b border-gray-100 pb-3">
                <i class="fa-regular fa-id-badge text-blue-600 mr-3"></i> Profil Pengguna
            </h3>
            
            <form action="{{ route('settings.profile') }}" method="POST" class="flex flex-col md:flex-row gap-8 items-start">
                @csrf
                <div class="flex flex-col items-center space-y-3">
                    <div class="w-24 h-24 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-3xl font-bold uppercase border-4 border-white shadow-md relative group cursor-pointer overflow-hidden">
                        {{ substr(auth()->user()->name, 0, 2) }}
                        <div class="absolute inset-0 bg-black/50 hidden group-hover:flex items-center justify-center transition-all">
                            <i class="fa-solid fa-camera text-white text-xl"></i>
                        </div>
                    </div>
                    <button type="button" class="text-xs font-bold text-blue-600 hover:underline">Ubah Foto</button>
                </div>

                <div class="flex-1 w-full grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ auth()->user()->name }}" class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-2.5 text-slate-700 focus:outline-none focus:border-blue-500 focus:bg-white transition-colors" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Email Address</label>
                        <input type="email" value="{{ auth()->user()->email }}" class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-2.5 text-slate-700 focus:outline-none focus:border-blue-500 focus:bg-white transition-colors" readonly>
                        <p class="text-[10px] text-gray-400 mt-1">*Email digunakan untuk login, hubungi admin untuk mengubah.</p>
                    </div>
                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nomor WhatsApp</label>
                        <div class="flex">
                            <span class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-gray-200 bg-gray-50 text-gray-500 text-sm font-bold">+62</span>
                            <input type="text" name="phone" value="{{ auth()->user()->phone ?? '' }}" placeholder="81234567890" class="flex-1 bg-slate-50 border border-gray-200 rounded-r-lg px-4 py-2.5 text-slate-700 focus:outline-none focus:border-blue-500 focus:bg-white transition-colors">
                        </div>
                    </div>
                    <div class="col-span-2">
                        <button type="submit" class="bg-[#1E3A8A] text-white px-5 py-2.5 rounded-lg text-sm font-bold hover:bg-blue-900 transition-colors shadow-sm mt-2">
                            Simpan Profil
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Security Section -->
        <div class="bg-white rounded-xl border border-gray-200 p-8 shadow-sm">
            <h3 class="text-lg font-bold text-[#1e3a5f] mb-6 flex items-center border-b border-gray-100 pb-3">
                <i class="fa-solid fa-shield-halved text-blue-600 mr-3"></i> Keamanan & Password
            </h3>
            
            <form action="{{ route('settings.password') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full max-w-2xl">
                @csrf
                <div class="col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Password Saat Ini</label>
                    <input type="password" name="current_password" placeholder="••••••••" class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-2.5 text-slate-700 focus:outline-none focus:border-blue-500 focus:bg-white transition-colors" required>
                    @error('current_password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Password Baru</label>
                    <input type="password" name="password" placeholder="Minimal 8 karakter" class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-2.5 text-slate-700 focus:outline-none focus:border-blue-500 focus:bg-white transition-colors" required>
                    @error('password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" placeholder="Ketik ulang password baru" class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-2.5 text-slate-700 focus:outline-none focus:border-blue-500 focus:bg-white transition-colors" required>
                </div>
                <div class="col-span-2 mt-2">
                    <button type="submit" class="bg-white border border-gray-300 text-gray-700 px-5 py-2.5 rounded-lg text-sm font-bold hover:bg-gray-50 transition-colors shadow-sm">
                        Update Password
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
