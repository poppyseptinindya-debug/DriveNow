@extends('layouts.app')

@section('title', 'DriveNow | Sewa Mobil Cepat & Premium')

@section('content')
<div class="space-y-16 py-6 animate-fade-in">
    <!-- Hero Header -->
    <div class="flex flex-col lg:flex-row items-center justify-between gap-12">
        <div class="space-y-6 max-w-2xl text-center lg:text-left">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700 dark:bg-indigo-950/40 dark:text-indigo-400 border border-indigo-100 dark:border-indigo-900/50">
                🚀 Solusi Transportasi Anda
            </span>
            <h1 class="text-4xl font-extrabold tracking-tight text-slate-900 dark:text-white sm:text-5xl lg:text-6xl leading-tight">
                Sewa Mobil Murah & <span class="text-indigo-600 dark:text-indigo-400">Premium</span> Tanpa Ribet.
            </h1>
            <p class="text-slate-500 dark:text-slate-400 text-base sm:text-lg leading-relaxed max-w-xl mx-auto lg:mx-0">
                Pilih armada kendaraan terbaik untuk perjalanan dinas, liburan keluarga, maupun acara spesial Anda. Dapatkan penawaran terbaik sekarang juga!
            </p>
            <div class="flex flex-wrap items-center justify-center lg:justify-start gap-4 pt-2">
                @auth
                    <a href="{{ route('dashboard') }}" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl transition-all shadow-lg shadow-indigo-500/20">
                        Buka Dashboard <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                @else
                    <a href="{{ route('register') }}" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl transition-all shadow-lg shadow-indigo-500/20">
                        Mulai Sewa Sekarang
                    </a>
                    <a href="{{ route('login') }}" class="px-6 py-3 bg-white hover:bg-slate-50 text-slate-700 dark:bg-slate-900 dark:hover:bg-slate-800 dark:text-slate-200 border border-slate-200 dark:border-slate-800 font-semibold rounded-xl transition-all shadow-sm">
                        Masuk Akun
                    </a>
                @endauth
            </div>
        </div>
        <!-- Decorative Vector/Art Container -->
        <div class="relative w-full lg:w-1/2 flex items-center justify-center">
            <div class="absolute w-72 h-72 rounded-full bg-indigo-600/10 blur-3xl -z-10"></div>
            <!-- Showcase image -->
            <div class="relative h-64 sm:h-80 w-full rounded-3xl border border-slate-200/50 dark:border-slate-800/30 overflow-hidden shadow-2xl group">
                <img src="{{ asset('showcase_car.png') }}" alt="DriveNow Premium Cars" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/20 to-transparent flex flex-col justify-end p-6 space-y-2">
                    <h3 class="font-extrabold text-white text-xl">DriveNow Premium Cars</h3>
                    <p class="text-xs text-slate-200 max-w-md">Kami menyediakan mobil-mobil terawat siap pakai demi kelancaran agenda penting Anda.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Fleet Promo Grid -->
    <div class="space-y-6 pt-10 border-t border-slate-200/50 dark:border-slate-800/50">
        <div class="text-center space-y-2">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white sm:text-3xl">Pilihan Armada Terbaik</h2>
            <p class="text-slate-400 dark:text-slate-500 text-sm max-w-md mx-auto">Beberapa pilihan mobil yang paling disukai oleh para customer kami.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($cars as $car)
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl overflow-hidden shadow-sm flex flex-col h-full">
                    <div class="relative bg-slate-100 dark:bg-slate-950 h-44 flex items-center justify-center overflow-hidden">
                        @if($car->gambar)
                            <img src="{{ str_starts_with($car->gambar, 'cars/') ? asset('storage/' . $car->gambar) : asset($car->gambar) }}" alt="{{ $car->nama_mobil }}" class="w-full h-full object-cover">
                        @else
                            <i class="fas fa-car-side text-slate-300 dark:text-slate-800 text-[64px]"></i>
                        @endif
                    </div>
                    <div class="p-5 flex-grow flex flex-col justify-between space-y-4">
                        <div class="space-y-1">
                            <span class="text-slate-400 dark:text-slate-500 text-xs font-semibold uppercase">{{ $car->jenis_mobil }}</span>
                            <h3 class="font-bold text-slate-800 dark:text-white text-lg leading-tight">{{ $car->nama_mobil }}</h3>
                        </div>
                        <div class="pt-4 border-t border-slate-100 dark:border-slate-800 flex justify-between items-center">
                            <div>
                                <p class="text-xs text-slate-400 dark:text-slate-500">Harga per Hari</p>
                                <p class="font-bold text-indigo-600 dark:text-indigo-400 text-base">Rp {{ number_format($car->harga_sewa_per_hari, 0, ',', '.') }}</p>
                            </div>
                            <a href="{{ route('cars.catalog') }}" class="px-4 py-2 text-xs font-semibold text-indigo-600 bg-indigo-50 hover:bg-indigo-100 dark:bg-indigo-950/40 dark:text-indigo-400 dark:hover:bg-indigo-950/80 rounded-xl transition-all">
                                Lihat Katalog
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Default Fleet Dummies when database is unseeded -->
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 text-center space-y-4">
                    <div class="h-12 w-12 rounded-xl bg-indigo-50 dark:bg-indigo-950/40 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-xl mx-auto"><i class="fas fa-car"></i></div>
                    <h3 class="font-bold text-slate-800 dark:text-white">Toyota Avanza</h3>
                    <p class="text-xs text-slate-500">Mobil keluarga andalan dengan kapasitas 7 penumpang yang lega dan hemat bahan bakar.</p>
                </div>
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 text-center space-y-4">
                    <div class="h-12 w-12 rounded-xl bg-indigo-50 dark:bg-indigo-950/40 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-xl mx-auto"><i class="fas fa-bolt"></i></div>
                    <h3 class="font-bold text-slate-800 dark:text-white">Honda Civic</h3>
                    <p class="text-xs text-slate-500">Sedan premium sporty dengan performa kencang dan kenyamanan berkendara tingkat tinggi.</p>
                </div>
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 text-center space-y-4">
                    <div class="h-12 w-12 rounded-xl bg-indigo-50 dark:bg-indigo-950/40 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-xl mx-auto"><i class="fas fa-mountain"></i></div>
                    <h3 class="font-bold text-slate-800 dark:text-white">Toyota Fortuner</h3>
                    <p class="text-xs text-slate-500">SUV gagah tangguh siap melibas segala medan jalanan untuk petualangan yang tak terlupakan.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
