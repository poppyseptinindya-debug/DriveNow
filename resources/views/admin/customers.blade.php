@extends('layouts.app')

@section('title', 'DriveNow | Daftar Pelanggan')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Daftar Pelanggan</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Lihat daftar lengkap akun pelanggan terdaftar di DriveNow.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-slate-700 bg-white dark:bg-slate-900 dark:text-slate-300 border border-slate-200 dark:border-slate-800 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800 transition-all shadow-sm">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>

    <!-- Table Container -->
    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-center border-collapse">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800 text-slate-500 dark:text-slate-400 text-xs font-semibold uppercase tracking-wider">
                        <th class="px-6 py-4">No</th>
                        <th class="px-6 py-4">Nama Pelanggan</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4">Bergabung Pada</th>
                        <th class="px-6 py-4">Jumlah Sewa</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-800 text-slate-700 dark:text-slate-300 text-sm">
                    @forelse($customers as $customer)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                            <td class="px-6 py-4 font-medium text-slate-500">{{ ($customers->currentPage() - 1) * $customers->perPage() + $loop->iteration }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-3">
                                    <div class="h-9 w-9 rounded-full bg-indigo-50 dark:bg-indigo-950 flex items-center justify-center text-indigo-600 dark:text-indigo-400 font-bold text-sm">
                                        {{ strtoupper(substr($customer->name, 0, 2)) }}
                                    </div>
                                    <span class="font-semibold text-slate-800 dark:text-slate-100">{{ $customer->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-mono text-xs">{{ $customer->email }}</td>
                            <td class="px-6 py-4">{{ $customer->created_at->translatedFormat('d F Y H:i') }}</td>
                            <td class="px-6 py-4 font-semibold text-indigo-600 dark:text-indigo-400">
                                {{ $customer->rentals()->count() }}x
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-500 dark:text-slate-400">
                                <div class="flex flex-col items-center gap-2">
                                    <i class="fas fa-users-slash text-4xl text-slate-300 dark:text-slate-700"></i>
                                    <span>Belum ada customer yang terdaftar.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($customers->hasPages())
            <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-800">
                {{ $customers->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
