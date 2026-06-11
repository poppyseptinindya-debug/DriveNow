@extends('layouts.app')

@section('title', 'DriveNow | Kelola Mobil')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Kelola Mobil</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Daftar kendaraan yang disewakan di DriveNow.</p>
        </div>
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full sm:w-auto">
            <form method="GET" action="{{ route('admin.cars.index') }}" class="relative w-full sm:w-64">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari mobil..." class="w-full pl-10 pr-4 py-2.5 text-sm border border-slate-200 dark:border-slate-800 rounded-xl bg-white dark:bg-slate-900 text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 transition-all shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 dark:text-slate-500 text-xs">
                    <i class="fas fa-search"></i>
                </div>
            </form>
            <a href="{{ route('admin.cars.create') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-600 dark:hover:bg-indigo-500 rounded-xl transition-all shadow-md shadow-indigo-500/10 whitespace-nowrap">
                <i class="fas fa-plus"></i> Tambah Mobil Baru
            </a>
        </div>
    </div>

    <!-- Cars Table Container -->
    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-center border-collapse">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800 text-slate-500 dark:text-slate-400 text-xs font-semibold uppercase tracking-wider">
                        <th class="px-6 py-4">No</th>
                        <th class="px-6 py-4">Gambar</th>
                        <th class="px-6 py-4">Nama Mobil</th>
                        <th class="px-6 py-4">Jenis Mobil</th>
                        <th class="px-6 py-4">Warna</th>
                        <th class="px-6 py-4">Tahun</th>
                        <th class="px-6 py-4">Harga Sewa / Hari</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-center"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-800 text-slate-700 dark:text-slate-300 text-sm">
                    @forelse($cars as $car)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                            <td class="px-6 py-4 text-slate-500">{{ ($cars->currentPage() - 1) * $cars->perPage() + $loop->iteration }}</td>
                            <td class="px-6 py-4">
                                @if($car->gambar)
                                    <img src="{{ str_starts_with($car->gambar, 'cars/') ? asset('storage/' . $car->gambar) : asset($car->gambar) }}" alt="{{ $car->nama_mobil }}" class="w-16 h-10 object-cover rounded-lg shadow-sm border border-slate-200 dark:border-slate-700 mx-auto">
                                @else
                                    <div class="w-16 h-10 bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-400 dark:text-slate-500 rounded-lg text-xs font-semibold mx-auto">
                                        No image
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-semibold text-slate-900 dark:text-white">{{ $car->nama_mobil }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800 dark:bg-slate-800 dark:text-slate-200">
                                    {{ $car->jenis_mobil }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-slate-500">{{ $car->warna ?? '-' }}</td>
                            <td class="px-6 py-4 text-slate-500">{{ $car->tahun ?? '-' }}</td>
                            <td class="px-6 py-4 font-semibold text-indigo-600 dark:text-indigo-400">Rp {{ number_format($car->harga_sewa_per_hari, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $car->status === 'Tersedia' ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950/30 dark:text-emerald-400' : 'bg-amber-100 text-amber-800 dark:bg-amber-950/30 dark:text-amber-400' }}">
                                    <span class="w-1.5 h-1.5 mr-1.5 rounded-full {{ $car->status === 'Tersedia' ? 'bg-emerald-500' : 'bg-amber-500' }}"></span>
                                    {{ $car->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('cars.show', $car) }}" class="p-2 text-slate-600 hover:text-indigo-600 dark:text-slate-400 dark:hover:text-indigo-400 transition-all" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.cars.edit', $car) }}" class="p-2 text-slate-600 hover:text-amber-600 dark:text-slate-400 dark:hover:text-amber-400 transition-all" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.cars.destroy', $car) }}" method="POST" class="inline" onsubmit="confirmDeleteForm(event, 'Apakah Anda yakin ingin menghapus mobil ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-slate-600 hover:text-rose-600 dark:text-slate-400 dark:hover:text-rose-400 transition-all" title="Hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-slate-500 dark:text-slate-400">
                                <div class="flex flex-col items-center gap-2">
                                    <i class="fas fa-car-side text-4xl text-slate-300 dark:text-slate-700"></i>
                                    <span>{{ request('search') ? 'Tidak ada data mobil yang cocok dengan pencarian Anda.' : 'Belum ada data mobil. Silakan tambahkan mobil baru.' }}</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($cars->hasPages())
            <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-800">
                {{ $cars->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
