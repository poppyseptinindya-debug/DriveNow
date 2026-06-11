@extends('layouts.app')

@section('title', 'DriveNow | Kelola Penyewaan')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Kelola Transaksi Penyewaan</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Daftar seluruh transaksi pemesanan sewa mobil dari seluruh customer.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-slate-700 bg-white dark:bg-slate-900 dark:text-slate-300 border border-slate-200 dark:border-slate-800 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800 transition-all shadow-sm">
            <i class="fas fa-arrow-left"></i> Dashboard
        </a>
    </div>

    <!-- Tab Navigation -->
    <div class="flex border-b border-slate-200 dark:border-slate-800 gap-6">
        <a href="{{ route('admin.rentals.index', ['tab' => 'transaksi', 'status' => 'semua']) }}" class="pb-3 text-sm font-semibold border-b-2 transition-all {{ $tab === 'transaksi' ? 'border-indigo-600 text-indigo-600 dark:border-indigo-400 dark:text-indigo-400' : 'border-transparent text-slate-500 hover:text-slate-800 dark:hover:text-slate-200' }}">
            <i class="fas fa-receipt mr-1.5"></i> Riwayat Transaksi (Persetujuan & Pembayaran)
        </a>
        <a href="{{ route('admin.rentals.index', ['tab' => 'penyewaan', 'status' => 'semua']) }}" class="pb-3 text-sm font-semibold border-b-2 transition-all {{ $tab === 'penyewaan' ? 'border-indigo-600 text-indigo-600 dark:border-indigo-400 dark:text-indigo-400' : 'border-transparent text-slate-500 hover:text-slate-800 dark:hover:text-slate-200' }}">
            <i class="fas fa-car mr-1.5"></i> Riwayat Penyewaan (Pengambilan & Penggunaan)
        </a>
    </div>

    <!-- Status Filters -->
    <div class="flex flex-wrap gap-2 text-xs">
        @if($tab === 'transaksi')
            <a href="{{ route('admin.rentals.index', ['tab' => 'transaksi', 'status' => 'semua']) }}" class="px-3.5 py-1.5 rounded-full font-semibold transition-all {{ $status === 'semua' ? 'bg-indigo-600 text-white dark:bg-indigo-500' : 'bg-slate-100 dark:bg-slate-800/80 text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-800' }}">
                Semua
            </a>
            <a href="{{ route('admin.rentals.index', ['tab' => 'transaksi', 'status' => 'menunggu_konfirmasi']) }}" class="px-3.5 py-1.5 rounded-full font-semibold transition-all {{ $status === 'menunggu_konfirmasi' ? 'bg-indigo-600 text-white dark:bg-indigo-500' : 'bg-slate-100 dark:bg-slate-800/80 text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-800' }}">
                Menunggu Konfirmasi
            </a>
            <a href="{{ route('admin.rentals.index', ['tab' => 'transaksi', 'status' => 'menunggu_pembayaran']) }}" class="px-3.5 py-1.5 rounded-full font-semibold transition-all {{ $status === 'menunggu_pembayaran' ? 'bg-indigo-600 text-white dark:bg-indigo-500' : 'bg-slate-100 dark:bg-slate-800/80 text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-800' }}">
                Menunggu Pembayaran
            </a>
            <a href="{{ route('admin.rentals.index', ['tab' => 'transaksi', 'status' => 'ditolak']) }}" class="px-3.5 py-1.5 rounded-full font-semibold transition-all {{ $status === 'ditolak' ? 'bg-indigo-600 text-white dark:bg-indigo-500' : 'bg-slate-100 dark:bg-slate-800/80 text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-800' }}">
                Ditolak / Batal
            </a>
            <a href="{{ route('admin.rentals.index', ['tab' => 'transaksi', 'status' => 'selesai']) }}" class="px-3.5 py-1.5 rounded-full font-semibold transition-all {{ $status === 'selesai' ? 'bg-indigo-600 text-white dark:bg-indigo-500' : 'bg-slate-100 dark:bg-slate-800/80 text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-800' }}">
                Selesai
            </a>
        @else
            <a href="{{ route('admin.rentals.index', ['tab' => 'penyewaan', 'status' => 'semua']) }}" class="px-3.5 py-1.5 rounded-full font-semibold transition-all {{ $status === 'semua' ? 'bg-indigo-600 text-white dark:bg-indigo-500' : 'bg-slate-100 dark:bg-slate-800/80 text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-800' }}">
                Semua
            </a>
            <a href="{{ route('admin.rentals.index', ['tab' => 'penyewaan', 'status' => 'menunggu_pengambilan']) }}" class="px-3.5 py-1.5 rounded-full font-semibold transition-all {{ $status === 'menunggu_pengambilan' ? 'bg-indigo-600 text-white dark:bg-indigo-500' : 'bg-slate-100 dark:bg-slate-800/80 text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-800' }}">
                Menunggu Pengambilan
            </a>
            <a href="{{ route('admin.rentals.index', ['tab' => 'penyewaan', 'status' => 'sedang_disewa']) }}" class="px-3.5 py-1.5 rounded-full font-semibold transition-all {{ $status === 'sedang_disewa' ? 'bg-indigo-600 text-white dark:bg-indigo-500' : 'bg-slate-100 dark:bg-slate-800/80 text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-800' }}">
                Sedang Disewa
            </a>
            <a href="{{ route('admin.rentals.index', ['tab' => 'penyewaan', 'status' => 'selesai']) }}" class="px-3.5 py-1.5 rounded-full font-semibold transition-all {{ $status === 'selesai' ? 'bg-indigo-600 text-white dark:bg-indigo-500' : 'bg-slate-100 dark:bg-slate-800/80 text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-800' }}">
                Selesai
            </a>
        @endif
    </div>

    <!-- Rentals Table Container -->
    <div id="rentalsContainer" data-tab="{{ $tab }}" class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-center border-collapse">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800 text-slate-500 dark:text-slate-400 text-xs font-semibold uppercase tracking-wider">
                        <th class="px-6 py-4">No</th>
                        <th class="px-6 py-4">Pelanggan</th>
                        <th class="px-6 py-4">Mobil</th>
                        <th class="px-6 py-4">Tgl Sewa</th>
                        <th class="px-6 py-4">Durasi</th>
                        <th class="px-6 py-4">Total Tarif</th>
                        <th class="px-6 py-4">Metode & Bukti</th>
                        @if($tab === 'transaksi')
                            <th class="px-6 py-4">Status Transaksi</th>
                        @else
                            <th class="px-6 py-4">Status Penyewaan</th>
                            <th class="px-6 py-4">Rating</th>
                            <th class="px-6 py-4">Komentar</th>
                        @endif
                        <th class="px-6 py-4 text-center"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-800 text-slate-700 dark:text-slate-300 text-sm">
                    @forelse($rentals as $rental)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-all duration-500">
                            <td class="px-6 py-4 text-slate-500">{{ ($rentals->currentPage() - 1) * $rentals->perPage() + $loop->iteration }}</td>
                            <td class="px-6 py-4">
                                <div class="font-semibold text-slate-800 dark:text-slate-200">{{ $rental->user->name }}</div>
                                <div class="text-xs text-slate-400 dark:text-slate-500 font-mono">{{ $rental->user->email }}</div>
                            </td>
                            <td class="px-6 py-4 font-semibold text-slate-900 dark:text-white">{{ $rental->car->nama_mobil }}</td>
                            <td class="px-6 py-4">{{ $rental->tanggal_sewa->translatedFormat('d F Y') }}</td>
                            <td class="px-6 py-4 font-semibold">{{ $rental->lama_sewa }} Hari</td>
                            <td class="px-6 py-4 font-semibold text-indigo-600 dark:text-indigo-400">Rp {{ number_format($rental->total_harga, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col items-center gap-1">
                                    <span class="font-medium text-slate-800 dark:text-slate-200">{{ $rental->metode_pembayaran }}</span>
                                    @if($rental->bukti_transfer)
                                        <button onclick="viewBukti('{{ asset('storage/' . $rental->bukti_transfer) }}')" class="inline-flex items-center text-xs font-semibold text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300">
                                            <i class="fas fa-image mr-1"></i> Lihat Bukti
                                        </button>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if($tab === 'transaksi')
                                    <div class="action-buttons-container flex items-center justify-center gap-2" data-metode="{{ $rental->metode_pembayaran }}">
                                        @php
                                            if ($rental->status_penyewaan === 'menunggu_konfirmasi') {
                                                $badgeClass = 'bg-amber-100 text-amber-800 dark:bg-amber-950/30 dark:text-amber-400';
                                                $dotClass = 'bg-amber-500';
                                                $statusLabel = 'Menunggu Konfirmasi';
                                            } elseif ($rental->status_penyewaan === 'menunggu_pembayaran') {
                                                $badgeClass = 'bg-yellow-100 text-yellow-800 dark:bg-yellow-950/30 dark:text-yellow-400';
                                                $dotClass = 'bg-yellow-500';
                                                $statusLabel = 'Menunggu Pembayaran';
                                            } elseif ($rental->status_penyewaan === 'ditolak') {
                                                $badgeClass = 'bg-rose-100 text-rose-800 dark:bg-rose-950/30 dark:text-rose-400';
                                                $dotClass = 'bg-rose-500';
                                                $statusLabel = 'Ditolak / Batal';
                                            } elseif ($rental->status_penyewaan === 'selesai') {
                                                $badgeClass = 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950/30 dark:text-emerald-400';
                                                $dotClass = 'bg-emerald-500';
                                                $statusLabel = 'Selesai';
                                            } else {
                                                $badgeClass = 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950/30 dark:text-emerald-400';
                                                $dotClass = 'bg-emerald-500';
                                                $statusLabel = 'Selesai';
                                            }
                                        @endphp
                                        <span class="status-badge inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badgeClass }}">
                                            <span class="w-1.5 h-1.5 mr-1.5 rounded-full {{ $dotClass }}"></span>
                                            <span class="status-text">{{ $statusLabel }}</span>
                                        </span>
                                        
                                        <!-- Kontrol Persetujuan Terpadu di Tab Transaksi -->
                                        @if($rental->status_penyewaan === 'menunggu_konfirmasi')
                                            <div class="flex items-center gap-1">
                                                @if($rental->metode_pembayaran === 'Transfer Bank')
                                                    <button onclick="updateRentalStatus({{ $rental->id }}, 'menunggu_pengambilan', this)" class="px-2 py-1 text-[11px] font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg transition-all shadow-sm">
                                                        Setujui
                                                    </button>
                                                @else
                                                    <button onclick="updateRentalStatus({{ $rental->id }}, 'menunggu_pembayaran', this)" class="px-2 py-1 text-[11px] font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg transition-all shadow-sm">
                                                        Setujui
                                                    </button>
                                                @endif
                                                <button onclick="updateRentalStatus({{ $rental->id }}, 'ditolak', this)" class="px-2 py-1 text-[11px] font-semibold text-rose-600 bg-rose-50 hover:bg-rose-100 dark:bg-rose-950/30 dark:text-rose-400 rounded-lg transition-all">
                                                    Tolak
                                                </button>
                                            </div>
                                        @elseif($rental->status_penyewaan === 'menunggu_pembayaran')
                                            <div class="flex items-center gap-1">
                                                <button onclick="updateRentalStatus({{ $rental->id }}, 'menunggu_pengambilan', this)" class="px-2.5 py-1 text-[11px] font-semibold text-white bg-emerald-600 hover:bg-emerald-700 rounded-lg transition-all shadow-sm">
                                                    Konfirmasi Bayar
                                                </button>
                                                <button onclick="updateRentalStatus({{ $rental->id }}, 'ditolak', this)" class="px-2.5 py-1 text-[11px] font-semibold text-rose-600 bg-rose-50 hover:bg-rose-100 dark:bg-rose-950/30 dark:text-rose-400 rounded-lg transition-all">
                                                    Batalkan
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                @else {{-- tab === 'penyewaan' --}}
                                    <div class="action-buttons-container flex items-center justify-center gap-2">
                                        @php
                                            $statusClasses = [
                                                'menunggu_pengambilan' => 'bg-blue-100 text-blue-800 dark:bg-blue-950/30 dark:text-blue-400',
                                                'sedang_disewa' => 'bg-indigo-100 text-indigo-800 dark:bg-indigo-950/30 dark:text-indigo-400',
                                                'selesai' => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950/30 dark:text-emerald-400'
                                            ];
                                            
                                            $statusLabels = [
                                                'menunggu_pengambilan' => 'Menunggu Pengambilan',
                                                'sedang_disewa' => 'Sedang Disewa',
                                                'selesai' => 'Selesai'
                                            ];
                                            
                                            $dotClasses = [
                                                'menunggu_pengambilan' => 'bg-blue-500',
                                                'sedang_disewa' => 'bg-indigo-500',
                                                'selesai' => 'bg-emerald-500'
                                            ];
                                        @endphp
                                        <span class="status-badge inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusClasses[$rental->status_penyewaan] }}">
                                            <span class="w-1.5 h-1.5 mr-1.5 rounded-full {{ $dotClasses[$rental->status_penyewaan] }}"></span>
                                            <span class="status-text">{{ $statusLabels[$rental->status_penyewaan] }}</span>
                                        </span>

                                        <!-- Kontrol Persetujuan Terpadu di Tab Penyewaan -->
                                        @if($rental->status_penyewaan === 'menunggu_pengambilan')
                                            <button onclick="updateRentalStatus({{ $rental->id }}, 'sedang_disewa', this)" class="px-2.5 py-1 text-[11px] font-semibold text-white bg-sky-600 hover:bg-sky-700 rounded-lg transition-all shadow-sm">
                                                Serahkan Mobil
                                            </button>
                                        @elseif($rental->status_penyewaan === 'sedang_disewa')
                                            <button onclick="updateRentalStatus({{ $rental->id }}, 'selesai', this)" class="px-2.5 py-1 text-[11px] font-semibold text-white bg-emerald-600 hover:bg-emerald-700 rounded-lg transition-all shadow-sm">
                                                Selesai
                                            </button>
                                        @endif
                                    </div>
                                @endif
                            </td>
                            @if($tab === 'penyewaan')
                                <td class="px-6 py-4">
                                    @if($rental->status_penyewaan === 'selesai' && $rental->rating)
                                        <div class="flex items-center justify-center text-amber-500 text-[10px]">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="{{ $i <= $rental->rating ? 'fas' : 'far' }} fa-star"></i>
                                            @endfor
                                        </div>
                                    @else
                                        <span class="text-slate-400 dark:text-slate-600">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($rental->status_penyewaan === 'selesai' && $rental->review)
                                        <p class="text-xs text-slate-700 dark:text-slate-300 italic max-w-[200px] truncate" title="{{ $rental->review }}">"{{ $rental->review }}"</p>
                                    @else
                                        <span class="text-slate-400 dark:text-slate-600">-</span>
                                    @endif
                                </td>
                            @endif
                            <td class="px-6 py-4 text-center">
                                @if($tab === 'transaksi')
                                    <!-- Aksi Hapus Khusus Kolom Transaksi -->
                                    <button onclick="deleteRental({{ $rental->id }}, this)" class="px-3 py-1.5 text-xs font-semibold text-rose-600 bg-rose-50 hover:bg-rose-100 dark:bg-rose-950/30 dark:text-rose-400 dark:hover:bg-rose-950/50 rounded-xl transition-all shadow-sm" title="Hapus Transaksi">
                                        <i class="fas fa-trash-alt mr-1"></i> Hapus
                                    </button>
                                @else
                                    <span class="text-slate-400 dark:text-slate-600">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ $tab === 'transaksi' ? 9 : 11 }}" class="px-6 py-12 text-center text-slate-500 dark:text-slate-400">
                                <div class="flex flex-col items-center gap-2">
                                    <i class="fas fa-receipt text-4xl text-slate-300 dark:text-slate-700"></i>
                                    <span>Belum ada transaksi sewa yang sesuai dengan filter ini.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($rentals->hasPages())
            <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-800">
                {{ $rentals->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Modal Lihat Bukti -->
<div id="buktiModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm p-4">
    <div class="bg-white dark:bg-slate-900 max-w-lg w-full rounded-3xl overflow-hidden border border-slate-200 dark:border-slate-800 shadow-2xl flex flex-col">
        <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center bg-slate-50 dark:bg-slate-950">
            <h3 class="font-bold text-slate-900 dark:text-white">Bukti Transfer</h3>
            <button onclick="closeBukti()" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="p-6 flex justify-center bg-slate-100 dark:bg-slate-950/40">
            <img id="buktiImage" class="max-h-[70vh] rounded-lg shadow-sm object-contain border border-slate-200 dark:border-slate-800" src="" alt="Bukti Transfer">
        </div>
    </div>
</div>


@endsection
