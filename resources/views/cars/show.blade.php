@extends('layouts.app')

@section('title', 'DriveNow | Detail Mobil')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center gap-4">
        @if(Auth::check() && Auth::user()->isAdmin())
            <a href="{{ route('admin.cars.index') }}" class="h-10 w-10 flex items-center justify-center rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-all">
                <i class="fas fa-arrow-left"></i>
            </a>
        @else
            <a href="{{ route('cars.catalog') }}" class="h-10 w-10 flex items-center justify-center rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-all">
                <i class="fas fa-arrow-left"></i>
            </a>
        @endif
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Detail Kendaraan</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-0.5">Informasi lengkap spesifikasi dan ketersediaan.</p>
        </div>
    </div>

    <!-- Main Detail Grid -->
    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl overflow-hidden shadow-sm grid grid-cols-1 md:grid-cols-2">
        <!-- Image Preview -->
        <div class="relative bg-slate-100 dark:bg-slate-950 p-6 flex items-center justify-center">
            @if($car->gambar)
                <img src="{{ str_starts_with($car->gambar, 'cars/') ? asset('storage/' . $car->gambar) : asset($car->gambar) }}" alt="{{ $car->nama_mobil }}" class="w-full h-64 object-contain rounded-2xl drop-shadow-md">
            @else
                <i class="fas fa-car-side text-slate-300 dark:text-slate-800 text-[120px]"></i>
            @endif
        </div>

        <!-- Details Info -->
        <div class="p-6 sm:p-8 flex flex-col justify-between space-y-6">
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700 dark:bg-indigo-950/40 dark:text-indigo-400">
                        {{ $car->jenis_mobil }}
                    </span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $car->status === 'Tersedia' ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950/30 dark:text-emerald-400' : 'bg-amber-100 text-amber-800 dark:bg-amber-950/30 dark:text-amber-400' }}">
                        <span class="w-1.5 h-1.5 mr-1.5 rounded-full {{ $car->status === 'Tersedia' ? 'bg-emerald-500' : 'bg-amber-500' }}"></span>
                        {{ $car->status }}
                    </span>
                </div>

                <h2 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $car->nama_mobil }}</h2>
                
                <div class="pt-4 border-t border-slate-200 dark:border-slate-800 space-y-3">
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-slate-500 dark:text-slate-400">Tarif Sewa</span>
                        <span class="font-bold text-indigo-600 dark:text-indigo-400 text-lg">Rp {{ number_format($car->harga_sewa_per_hari, 0, ',', '.') }} <span class="text-xs text-slate-400 font-normal">/ hari</span></span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-slate-500 dark:text-slate-400">Warna Mobil</span>
                        <span class="font-semibold text-slate-800 dark:text-slate-200">{{ $car->warna ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-slate-500 dark:text-slate-400">Tahun Produksi</span>
                        <span class="font-semibold text-slate-800 dark:text-slate-200">{{ $car->tahun ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-slate-500 dark:text-slate-400">Kapasitas Penumpang</span>
                        <span class="font-semibold text-slate-800 dark:text-slate-200">5 - 7 Kursi</span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-slate-500 dark:text-slate-400">Transmisi</span>
                        <span class="font-semibold text-slate-800 dark:text-slate-200">Automatic / Manual</span>
                    </div>
                </div>
            </div>

            <!-- Booking/Edit Action -->
            <div class="pt-6 border-t border-slate-200 dark:border-slate-800">
                @auth
                    @if(Auth::user()->isAdmin())
                        <div class="flex gap-4">
                            <a href="{{ route('admin.cars.edit', $car) }}" class="flex-1 py-3 text-center bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold rounded-xl transition-all shadow-md shadow-amber-500/10">
                                <i class="fas fa-edit mr-1.5"></i> Edit Mobil
                            </a>
                            <form action="{{ route('admin.cars.destroy', $car) }}" method="POST" class="flex-1" onsubmit="confirmDeleteForm(event, 'Apakah Anda yakin ingin menghapus mobil ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full py-3 bg-rose-600 hover:bg-rose-700 text-white font-bold rounded-xl transition-all shadow-md shadow-rose-500/10">
                                    <i class="fas fa-trash-alt mr-1.5"></i> Hapus
                                </button>
                            </form>
                        </div>
                    @else
                        @if($car->status === 'Tersedia')
                            <a href="{{ route('rentals.create', ['car_id' => $car->id]) }}" class="block w-full py-3.5 text-center bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-600 dark:hover:bg-indigo-500 text-white font-bold rounded-xl transition-all shadow-md shadow-indigo-500/10">
                                <i class="fas fa-key mr-1.5"></i> Sewa Mobil Ini Sekarang
                            </a>
                        @else
                            <button disabled class="w-full py-3.5 text-center bg-slate-200 dark:bg-slate-800 text-slate-400 dark:text-slate-600 font-bold rounded-xl cursor-not-allowed">
                                <i class="fas fa-ban mr-1.5"></i> Mobil Sedang Disewa
                            </button>
                        @endif
                    @endif
                @else
                    <a href="{{ route('login') }}" class="block w-full py-3.5 text-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all shadow-md shadow-indigo-500/10">
                        Login untuk Menyewa
                    </a>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection
