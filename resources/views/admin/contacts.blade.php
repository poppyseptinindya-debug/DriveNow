@extends('layouts.app')

@section('title', 'DriveNow | Saran Pelanggan')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Saran Pelanggan</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Daftar saran, kritik, dan masukan yang dikirimkan oleh pelanggan melalui kotak saran.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-slate-700 bg-white dark:bg-slate-900 dark:text-slate-300 border border-slate-200 dark:border-slate-800 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800 transition-all shadow-sm">
            <i class="fas fa-arrow-left"></i> Dashboard
        </a>
    </div>

    <!-- Messages Table Container -->
    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-center border-collapse">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800 text-slate-500 dark:text-slate-400 text-xs font-semibold uppercase tracking-wider">
                        <th class="px-6 py-4">No</th>
                        <th class="px-6 py-4">Nama Pengirim</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4">Isi Saran</th>
                        <th class="px-6 py-4">Tanggal Kirim</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-800 text-slate-700 dark:text-slate-300 text-sm">
                    @forelse($contacts as $contact)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-all duration-500">
                            <td class="px-6 py-4 text-slate-500">{{ ($contacts->currentPage() - 1) * $contacts->perPage() + $loop->iteration }}</td>
                            <td class="px-6 py-4 font-semibold text-slate-800 dark:text-slate-200">{{ $contact->name }}</td>
                            <td class="px-6 py-4 font-mono text-xs text-slate-500 dark:text-slate-400">{{ $contact->email }}</td>
                            <td class="px-6 py-4 whitespace-normal break-words max-w-md">{{ $contact->message }}</td>
                            <td class="px-6 py-4 text-slate-500 text-xs">{{ $contact->created_at->translatedFormat('d F Y H:i') }}</td>
                            <td class="px-6 py-4 text-center">
                                <button onclick="deleteContact({{ $contact->id }}, this)" class="px-3 py-1.5 text-xs font-semibold text-rose-600 bg-rose-50 hover:bg-rose-100 dark:bg-rose-950/30 dark:text-rose-400 dark:hover:bg-rose-950/50 rounded-xl transition-all shadow-sm" title="Hapus Saran">
                                    <i class="fas fa-trash-alt mr-1"></i> Hapus
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500 dark:text-slate-400">
                                <div class="flex flex-col items-center gap-2">
                                    <i class="fas fa-envelope-open text-4xl text-slate-300 dark:text-slate-700"></i>
                                    <span>Belum ada saran masuk dari pelanggan.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($contacts->hasPages())
            <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-800">
                {{ $contacts->links() }}
            </div>
        @endif
    </div>
</div>


@endsection
