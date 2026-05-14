@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen pb-20">
    <div class="bg-[#1E3A8A] pt-16 pb-24 px-6">
        <div class="container mx-auto text-center">
            <h1 class="text-3xl font-bold text-white mb-2">Berikan Ulasan</h1>
            <!-- Variabel disesuaikan menjadi $property->name -->
            <p class="text-blue-100 opacity-80">Bagikan pengalaman Anda menginap di {{ $property->name }}</p>
        </div>
    </div>

    <div class="container mx-auto px-6 -mt-12">
        <div class="max-w-2xl mx-auto bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
            <div class="p-8">
                <!-- Rute diubah menjadi customer.rate -->
                <form action="{{ route('customer.rate') }}" method="POST">
                    @csrf
                    <!-- Nama input disesuaikan menjadi property_id dan nilainya dari $property->id -->
                    <input type="hidden" name="property_id" value="{{ $property->id }}">

                    <!-- Input Rating Bintang -->
                    <div class="text-center mb-8">
                        <label class="block text-gray-700 font-bold mb-4">Seberapa puas Anda dengan properti ini?</label>
                        <div class="flex justify-center gap-4 text-3xl">
                            @for($i = 1; $i <= 5; $i++)
                            <label class="cursor-pointer hover:scale-125 transition-transform">
                                <input type="radio" name="rating" value="{{ $i }}" class="hidden peer" required>
                                <i class="fa-solid fa-star text-gray-200 peer-checked:text-yellow-400"></i>
                            </label>
                            @endfor
                        </div>
                        <p class="text-xs text-gray-400 mt-4">Klik pada bintang untuk memberikan nilai</p>
                    </div>

                    <!-- Input Ulasan Teks -->
                    <div class="mb-8">
                        <label class="block text-gray-700 font-bold mb-2">Tulis ulasan Anda</label>
                        <textarea name="ulasan" rows="5" required
                            placeholder="Ceritakan fasilitas, kebersihan, atau keramahan pemilik properti..."
                            class="w-full p-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:bg-white transition-all"></textarea>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="flex gap-4">
                        <!-- Rute batal diubah ke customer.billing -->
                        <a href="{{ route('customer.billing') }}" class="w-1/3 flex items-center justify-center py-4 rounded-xl font-bold text-gray-500 hover:bg-gray-50 transition border border-gray-200">
                            Batal
                        </a>
                        <button type="submit" class="w-2/3 bg-teal-600 text-white font-bold py-4 rounded-xl hover:bg-teal-700 transition shadow-lg shadow-teal-600/20">
                            Kirim Ulasan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="max-w-2xl mx-auto mt-8 p-6 bg-blue-50 rounded-2xl border border-blue-100 flex gap-4 items-start">
            <i class="fa-solid fa-circle-info text-blue-500 mt-1"></i>
            <p class="text-xs text-blue-800 leading-relaxed">
                Ulasan Anda akan tampil secara publik di halaman detail properti. Mohon berikan ulasan yang jujur dan sopan untuk membantu pencari lainnya di <strong>GRAHA</strong>.
            </p>
        </div>
    </div>
</div>
@endsection