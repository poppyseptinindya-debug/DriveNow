@extends('layouts.app')

@section('title', 'DriveNow | Katalog Mobil')

@section('content')
<div class="space-y-8 animate-fade-in">
    <!-- Header Block -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white sm:text-3xl">Katalog Mobil</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm sm:text-base mt-1">Pilih kendaraan terbaik untuk perjalanan Anda.</p>
        </div>
        
        <!-- Live Search Field & Form -->
        <form method="GET" action="{{ route('cars.catalog') }}" class="w-full md:w-80 relative flex items-center">
            <span class="absolute left-4 text-slate-400 dark:text-slate-500">
                <i class="fas fa-search"></i>
            </span>
            <input type="text" id="searchInput" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan nama atau jenis..." class="w-full pl-11 pr-4 py-3 border border-slate-200 dark:border-slate-800 rounded-2xl bg-white dark:bg-slate-900 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:focus:ring-indigo-500 transition-all text-sm shadow-sm">
        </form>
    </div>

    <!-- Catalog Grid Container -->
    <div id="catalogContainer" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($cars as $car)
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl overflow-hidden shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex flex-col h-full">
                <!-- Thumbnail -->
                <div class="relative bg-slate-100 dark:bg-slate-950 h-48 flex items-center justify-center overflow-hidden">
                    @if($car->gambar)
                        <img src="{{ str_starts_with($car->gambar, 'cars/') ? asset('storage/' . $car->gambar) : asset($car->gambar) }}" alt="{{ $car->nama_mobil }}" class="w-full h-full object-cover">
                    @else
                        <i class="fas fa-car-side text-slate-300 dark:text-slate-800 text-[80px]"></i>
                    @endif
                    <!-- Status Badge -->
                    <span class="absolute top-4 right-4 inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold backdrop-blur-md {{ $car->status === 'Tersedia' ? 'bg-emerald-100/90 text-emerald-800 dark:bg-emerald-950/80 dark:text-emerald-400' : 'bg-amber-100/90 text-amber-800 dark:bg-amber-950/80 dark:text-amber-400' }}">
                        <span class="w-1.5 h-1.5 mr-1.5 rounded-full {{ $car->status === 'Tersedia' ? 'bg-emerald-500' : 'bg-amber-500' }}"></span>
                        {{ $car->status }}
                    </span>
                </div>
                <!-- Card Body -->
                <div class="p-6 flex-grow flex flex-col justify-between space-y-4">
                    <div class="space-y-1">
                        <div class="flex items-center justify-between text-xs font-semibold uppercase tracking-wider text-slate-400 dark:text-slate-500">
                            <span>{{ $car->jenis_mobil }}</span>
                            <span>{{ $car->warna ?? '-' }} | {{ $car->tahun ?? '-' }}</span>
                        </div>
                        <h3 class="font-bold text-slate-800 dark:text-white text-lg leading-tight">{{ $car->nama_mobil }}</h3>
                    </div>
                    
                    <div class="pt-4 border-t border-slate-100 dark:border-slate-800 flex justify-between items-center">
                        <div>
                            <p class="text-xs text-slate-400 dark:text-slate-500">Tarif Sewa</p>
                            <p class="font-extrabold text-indigo-600 dark:text-indigo-400 text-lg">Rp {{ number_format($car->harga_sewa_per_hari, 0, ',', '.') }}<span class="text-xs font-normal text-slate-400">/hari</span></p>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('cars.show', $car) }}" class="px-4 py-2.5 text-xs font-bold text-slate-700 bg-slate-50 hover:bg-slate-100 dark:bg-slate-800/60 dark:text-slate-300 dark:hover:bg-slate-800 rounded-xl transition-all border border-slate-200/50 dark:border-slate-700/50">
                                Detail
                            </a>
                            @if($car->status === 'Tersedia')
                                <a href="{{ route('rentals.create', ['car_id' => $car->id]) }}" class="px-4 py-2.5 text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl transition-all shadow-md shadow-indigo-600/10">
                                    Sewa
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-16 text-center text-slate-500 dark:text-slate-400 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl">
                <i class="fas fa-car-crash text-5xl text-slate-300 dark:text-slate-700 mb-3"></i>
                <p class="text-lg font-semibold">Armada tidak ditemukan</p>
                <p class="text-sm mt-1 text-slate-400">Silakan gunakan kata kunci pencarian yang lain.</p>
            </div>
        @endforelse
    </div>
    
    <!-- Original Pagination links -->
    <div id="paginationContainer" class="flex justify-center pt-4">
        {{ $cars->links() }}
    </div>
</div>


@endsection
