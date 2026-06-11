@extends('layouts.app')

@section('title', 'DriveNow | Dashboard')

@section('content')
<div class="space-y-8 animate-fade-in">
    <!-- Welcome Hero -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-indigo-950 to-indigo-900 p-8 shadow-xl text-white">
        <div class="relative z-10 space-y-4 max-w-xl">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-indigo-500/20 text-indigo-300 border border-indigo-500/30">
                ⭐ Selamat Datang Kembali!
            </span>
            <h1 class="text-3xl font-extrabold tracking-tight sm:text-4xl">Temukan Mobil Pilihan Anda, {{ Auth::user()->name }}!</h1>
            <p class="text-indigo-200/80 text-sm sm:text-base">
                Nikmati kenyamanan sewa mobil premium dengan proses cepat, harga transparan, dan unit yang terjamin kebersihannya.
            </p>
            <div class="flex flex-wrap gap-3 pt-2">
                <a href="{{ route('cars.catalog') }}" class="px-5 py-2.5 text-sm font-semibold bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl transition-all shadow-md shadow-indigo-600/20">
                    Cari Mobil <i class="fas fa-search ml-1"></i>
                </a>
                <a href="{{ route('rentals.history') }}" class="px-5 py-2.5 text-sm font-semibold bg-white/10 hover:bg-white/20 text-white rounded-xl transition-all">
                    Riwayat Sewa
                </a>
            </div>
        </div>
        <!-- Decorative Car Image/Icon -->
        <div class="absolute right-0 bottom-0 opacity-10 translate-y-1/6 translate-x-1/6 scale-150 hidden md:block">
            <i class="fas fa-car text-[220px]"></i>
        </div>
    </div>

    <!-- Quick Info Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="p-6 bg-white dark:bg-slate-900 border border-slate-200/50 dark:border-slate-800/50 rounded-3xl flex items-center gap-4 shadow-sm hover:shadow-md transition-all">
            <div class="h-12 w-12 rounded-2xl bg-indigo-50 dark:bg-indigo-950/40 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-xl">
                <i class="fas fa-history"></i>
            </div>
            <div>
                <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Penyewaan Anda</p>
                <h3 class="text-2xl font-bold text-slate-800 dark:text-slate-100">{{ $totalPenyewaan }} Transaksi</h3>
            </div>
        </div>
        <div class="p-6 bg-white dark:bg-slate-900 border border-slate-200/50 dark:border-slate-800/50 rounded-3xl flex items-center gap-4 shadow-sm hover:shadow-md transition-all">
            <div class="h-12 w-12 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-xl">
                <i class="fas fa-check-circle"></i>
            </div>
            <div>
                <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Mobil Siap Jalan</p>
                <h3 class="text-2xl font-bold text-slate-800 dark:text-slate-100">{{ $mobilTersedia }} Unit Tersedia</h3>
            </div>
        </div>
        <div class="p-6 bg-white dark:bg-slate-900 border border-slate-200/50 dark:border-slate-800/50 rounded-3xl flex items-center gap-4 shadow-sm hover:shadow-md transition-all">
            <div class="h-12 w-12 rounded-2xl bg-amber-50 dark:bg-amber-950/40 text-amber-600 dark:text-amber-400 flex items-center justify-center text-xl">
                <i class="fas fa-car"></i>
            </div>
            <div>
                <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Armada Mobil</p>
                <h3 class="text-2xl font-bold text-slate-800 dark:text-slate-100">{{ $totalMobil }} Unit Armada</h3>
            </div>
        </div>
    </div>

    <!-- Featured Cars section -->
    <div class="space-y-4">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-bold text-slate-900 dark:text-white">Rekomendasi Mobil Terbaru</h2>
            <a href="{{ route('cars.catalog') }}" class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:underline">Lihat Semua <i class="fas fa-arrow-right ml-1"></i></a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($mobilPopuler as $car)
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl overflow-hidden shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex flex-col h-full">
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
                            <a href="{{ route('cars.show', $car) }}" class="px-4 py-2 text-xs font-semibold text-indigo-600 bg-indigo-50 hover:bg-indigo-100 dark:bg-indigo-950/40 dark:text-indigo-400 dark:hover:bg-indigo-950/80 rounded-xl transition-all">
                                Detail Mobil
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center text-slate-500 dark:text-slate-400 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl">
                    <i class="fas fa-car-crash text-4xl text-slate-300 dark:text-slate-700 mb-2"></i>
                    <p>Maaf, belum ada armada mobil yang tersedia saat ini.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
