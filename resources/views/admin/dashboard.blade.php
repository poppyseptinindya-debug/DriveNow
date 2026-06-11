@extends('layouts.app')

@section('title', 'DriveNow | Admin Dashboard')

@section('content')
<div class="space-y-8 animate-fade-in">
    <!-- Welcome Banner -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-indigo-600 via-indigo-700 to-purple-800 p-8 shadow-xl text-white">
        <div class="relative z-10 space-y-2">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-white/20 backdrop-blur-md">
                <i class="fas fa-shield-alt mr-1.5"></i> Administrator Mode
            </span>
            <h1 class="text-3xl font-extrabold tracking-tight sm:text-4xl">Selamat Datang, {{ Auth::user()->name }}!</h1>
            <p class="max-w-xl text-indigo-100 text-sm sm:text-base">
                Kelola kendaraan, setujui penyewaan dari customer, dan awasi statistik operasional DriveNow hari ini.
            </p>
        </div>
        <!-- Background decorative vectors -->
        <div class="absolute right-0 bottom-0 opacity-10 translate-y-1/4 translate-x-1/4 scale-150">
            <i class="fas fa-car-side text-[200px]"></i>
        </div>
    </div>

    <!-- Quick Stats Grid -->
    <div>
        <h2 class="text-xl font-bold tracking-tight text-slate-900 dark:text-white mb-4">Statistik Rental</h2>
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-5">
            <!-- Card 1 -->
            <div class="p-6 bg-white dark:bg-slate-900 rounded-3xl border border-slate-200/50 dark:border-slate-800/50 shadow-sm hover:shadow-md transition-all duration-300">
                <div class="flex items-center gap-4">
                    <div class="h-12 w-12 rounded-2xl bg-indigo-50 dark:bg-indigo-950/30 flex items-center justify-center text-indigo-600 dark:text-indigo-400 text-xl">
                        <i class="fas fa-car"></i>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Mobil</p>
                        <h3 class="text-2xl font-bold text-slate-800 dark:text-slate-100">{{ $totalMobil }}</h3>
                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="p-6 bg-white dark:bg-slate-900 rounded-3xl border border-slate-200/50 dark:border-slate-800/50 shadow-sm hover:shadow-md transition-all duration-300">
                <div class="flex items-center gap-4">
                    <div class="h-12 w-12 rounded-2xl bg-emerald-50 dark:bg-emerald-950/30 flex items-center justify-center text-emerald-600 dark:text-emerald-400 text-xl">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Tersedia</p>
                        <h3 class="text-2xl font-bold text-slate-800 dark:text-slate-100">{{ $mobilTersedia }}</h3>
                    </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="p-6 bg-white dark:bg-slate-900 rounded-3xl border border-slate-200/50 dark:border-slate-800/50 shadow-sm hover:shadow-md transition-all duration-300">
                <div class="flex items-center gap-4">
                    <div class="h-12 w-12 rounded-2xl bg-amber-50 dark:bg-amber-950/30 flex items-center justify-center text-amber-600 dark:text-amber-400 text-xl">
                        <i class="fas fa-key"></i>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Disewa</p>
                        <h3 class="text-2xl font-bold text-slate-800 dark:text-slate-100">{{ $mobilDisewa }}</h3>
                    </div>
                </div>
            </div>
            <!-- Card 4 -->
            <div class="p-6 bg-white dark:bg-slate-900 rounded-3xl border border-slate-200/50 dark:border-slate-800/50 shadow-sm hover:shadow-md transition-all duration-300">
                <div class="flex items-center gap-4">
                    <div class="h-12 w-12 rounded-2xl bg-sky-50 dark:bg-sky-950/30 flex items-center justify-center text-sky-600 dark:text-sky-400 text-xl">
                        <i class="fas fa-users"></i>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Customer</p>
                        <h3 class="text-2xl font-bold text-slate-800 dark:text-slate-100">{{ $totalCustomer }}</h3>
                    </div>
                </div>
            </div>
            <!-- Card 5 -->
            <div class="p-6 bg-white dark:bg-slate-900 rounded-3xl border border-slate-200/50 dark:border-slate-800/50 shadow-sm hover:shadow-md transition-all duration-300">
                <div class="flex items-center gap-4">
                    <div class="h-12 w-12 rounded-2xl bg-purple-50 dark:bg-purple-950/30 flex items-center justify-center text-purple-600 dark:text-purple-400 text-xl">
                        <i class="fas fa-file-invoice-dollar"></i>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Penyewaan</p>
                        <h3 class="text-2xl font-bold text-slate-800 dark:text-slate-100">{{ $totalPenyewaan }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Management Controls -->
    <div>
        <h2 class="text-xl font-bold tracking-tight text-slate-900 dark:text-white mb-4">Navigasi Cepat Admin</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Action 1 -->
            <div class="relative overflow-hidden group p-6 bg-white dark:bg-slate-900 rounded-3xl border border-slate-200/50 dark:border-slate-800/50 shadow-sm hover:shadow-lg transition-all duration-300">
                <div class="space-y-4">
                    <div class="h-12 w-12 rounded-2xl bg-indigo-100 dark:bg-indigo-950/40 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-xl">
                        <i class="fas fa-car-side"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-800 dark:text-white">Kelola Armada Mobil</h3>
                        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Tambah mobil baru, edit detail mobil, atau hapus armada yang sudah ada.</p>
                    </div>
                    <a href="{{ route('admin.cars.index') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:gap-2.5 transition-all">
                        Buka Manajemen Mobil <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Action 2 -->
            <div class="relative overflow-hidden group p-6 bg-white dark:bg-slate-900 rounded-3xl border border-slate-200/50 dark:border-slate-800/50 shadow-sm hover:shadow-lg transition-all duration-300">
                <div class="space-y-4">
                    <div class="h-12 w-12 rounded-2xl bg-emerald-100 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-xl">
                        <i class="fas fa-file-contract"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-800 dark:text-white">Daftar Transaksi Penyewaan</h3>
                        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Verifikasi pengajuan sewa, tandai selesai sewa, atau batalkan sewa customer.</p>
                    </div>
                    <a href="{{ route('admin.rentals.index') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-emerald-600 dark:text-emerald-400 hover:gap-2.5 transition-all">
                        Buka Manajemen Sewa <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Action 3 -->
            <div class="relative overflow-hidden group p-6 bg-white dark:bg-slate-900 rounded-3xl border border-slate-200/50 dark:border-slate-800/50 shadow-sm hover:shadow-lg transition-all duration-300">
                <div class="space-y-4">
                    <div class="h-12 w-12 rounded-2xl bg-sky-100 dark:bg-sky-950/40 text-sky-600 dark:text-sky-400 flex items-center justify-center text-xl">
                        <i class="fas fa-user-friends"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-800 dark:text-white">Daftar Akun Customer</h3>
                        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Lihat profil semua pelanggan terdaftar, periksa email dan riwayat akun.</p>
                    </div>
                    <a href="{{ route('admin.customers.index') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-sky-600 dark:text-sky-400 hover:gap-2.5 transition-all">
                        Buka Daftar Customer <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
