@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-12 flex items-center justify-center">
    <div class="container mx-auto max-w-md px-6">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 text-blue-600 rounded-full mb-4 shadow-sm">
                <i class="fa-solid fa-user-shield text-3xl"></i>
            </div>
            <h1 class="text-2xl font-black text-gray-800">Lengkapi Profil Landlord</h1>
            <p class="text-xs text-gray-500 mt-2 leading-relaxed">
                Sebelum mengelola kos, harap lengkapi data diri Anda untuk keperluan validasi identitas dan keamanan penyewa.
            </p>
        </div>

        @if(session('warning'))
        <div class="bg-amber-50 border border-amber-100 p-4 rounded-2xl mb-6 shadow-sm">
            <p class="text-amber-800 text-xs font-bold text-center flex items-center justify-center gap-2">
                <i class="fa-solid fa-triangle-exclamation"></i> {{ session('warning') }}
            </p>
        </div>
        @endif

        <!-- Form Card -->
        <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100">
            <form action="{{ route('landlord.profile.store') }}" method="POST" class="space-y-5">
                @csrf
                
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1.5 uppercase tracking-wide">Nomor Telepon / WhatsApp</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                            <i class="fa-solid fa-phone"></i>
                        </span>
                        <input type="text" name="phone_number" value="{{ old('phone_number') }}" required 
                            class="w-full bg-gray-50 border border-gray-200 text-gray-800 text-sm rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 block pl-10 p-3 transition" 
                            placeholder="Contoh: 081234567890">
                    </div>
                    @error('phone_number')
                        <p class="text-red-500 text-[10px] font-bold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1.5 uppercase tracking-wide">Jenis Kelamin</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                            <i class="fa-solid fa-venus-mars"></i>
                        </span>
                        <select name="gender" required 
                            class="w-full bg-gray-50 border border-gray-200 text-gray-800 text-sm rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 block pl-10 p-3 transition appearance-none cursor-pointer">
                            <option value="" disabled selected>Pilih Jenis Kelamin</option>
                            <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 pointer-events-none">
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </span>
                    </div>
                    @error('gender')
                        <p class="text-red-500 text-[10px] font-bold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1.5 uppercase tracking-wide">Pekerjaan</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                            <i class="fa-solid fa-briefcase"></i>
                        </span>
                        <input type="text" name="pekerjaan" value="{{ old('pekerjaan') }}" required 
                            class="w-full bg-gray-50 border border-gray-200 text-gray-800 text-sm rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 block pl-10 p-3 transition" 
                            placeholder="Contoh: Wiraswasta, Karyawan, dll">
                    </div>
                    @error('pekerjaan')
                        <p class="text-red-500 text-[10px] font-bold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-4">
                    <button type="submit" 
                        class="w-full bg-[#1E3A8A] hover:bg-blue-900 text-white font-bold py-3.5 rounded-xl text-sm transition shadow-md flex items-center justify-center gap-2 active:scale-95">
                        <i class="fa-solid fa-check-circle"></i> Simpan & Mulai Kelola Properti
                    </button>
                </div>
            </form>
        </div>
        
    </div>
</div>
@endsection
