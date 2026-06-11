@extends('layouts.app')

@section('title', 'DriveNow | Riwayat Penyewaan')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Riwayat Penyewaan</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Daftar transaksi penyewaan mobil Anda di DriveNow.</p>
        </div>
        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-slate-700 bg-white dark:bg-slate-900 dark:text-slate-300 border border-slate-200 dark:border-slate-800 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800 transition-all shadow-sm">
            <i class="fas fa-arrow-left"></i> Dashboard
        </a>
    </div>

    <!-- History Table Container -->
    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-center border-collapse">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800 text-slate-500 dark:text-slate-400 text-xs font-semibold uppercase tracking-wider">
                        <th class="px-6 py-4">No</th>
                        <th class="px-6 py-4">Mobil</th>
                        <th class="px-6 py-4">Tanggal Sewa</th>
                        <th class="px-6 py-4">Durasi</th>
                        <th class="px-6 py-4">Total Harga</th>
                        <th class="px-6 py-4">Metode & Bukti</th>
                        <th class="px-6 py-4">Status Sewa</th>
                        <th class="px-6 py-4 text-center">Ulasan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-800 text-slate-700 dark:text-slate-300 text-sm">
                    @forelse($rentals as $rental)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                            <td class="px-6 py-4 text-slate-500">{{ ($rentals->currentPage() - 1) * $rentals->perPage() + $loop->iteration }}</td>
                            <td class="px-6 py-4 font-semibold text-slate-950 dark:text-white">{{ $rental->car->nama_mobil }}</td>
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
                                @php
                                    $statusClasses = [
                                        'menunggu_konfirmasi' => 'bg-amber-100 text-amber-800 dark:bg-amber-950/30 dark:text-amber-400',
                                        'menunggu_pembayaran' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-950/30 dark:text-yellow-400',
                                        'menunggu_pengambilan' => 'bg-blue-100 text-blue-800 dark:bg-blue-950/30 dark:text-blue-400',
                                        'sedang_disewa' => 'bg-indigo-100 text-indigo-800 dark:bg-indigo-950/30 dark:text-indigo-400',
                                        'selesai' => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950/30 dark:text-emerald-400',
                                        'ditolak' => 'bg-rose-100 text-rose-800 dark:bg-rose-950/30 dark:text-rose-400'
                                    ];
                                    
                                    $statusLabels = [
                                        'menunggu_konfirmasi' => 'Menunggu Konfirmasi',
                                        'menunggu_pembayaran' => 'Menunggu Pembayaran',
                                        'menunggu_pengambilan' => 'Menunggu Pengambilan',
                                        'sedang_disewa' => 'Sedang Disewa',
                                        'selesai' => 'Selesai',
                                        'ditolak' => 'Ditolak / Batal'
                                    ];
                                    
                                    $dotClasses = [
                                        'menunggu_konfirmasi' => 'bg-amber-500',
                                        'menunggu_pembayaran' => 'bg-yellow-500',
                                        'menunggu_pengambilan' => 'bg-blue-500',
                                        'sedang_disewa' => 'bg-indigo-500',
                                        'selesai' => 'bg-emerald-500',
                                        'ditolak' => 'bg-rose-500'
                                    ];
                                @endphp
                                <span class="status-badge inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusClasses[$rental->status_penyewaan] }}">
                                    <span class="w-1.5 h-1.5 mr-1.5 rounded-full {{ $dotClasses[$rental->status_penyewaan] }}"></span>
                                    {{ $statusLabels[$rental->status_penyewaan] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if(in_array($rental->status_penyewaan, ['menunggu_konfirmasi', 'menunggu_pembayaran']))
                                    <button onclick="cancelBooking({{ $rental->id }}, this)" class="px-3 py-1.5 text-xs font-semibold text-rose-600 bg-rose-50 hover:bg-rose-100 dark:bg-rose-950/30 dark:text-rose-400 dark:hover:bg-rose-950/50 rounded-xl transition-all shadow-sm">
                                        <i class="fas fa-ban mr-1"></i> Batalkan
                                    </button>
                                @elseif($rental->status_penyewaan === 'selesai')
                                    @if($rental->rating)
                                        <div class="flex items-center justify-center gap-1 text-amber-500 text-xs">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="{{ $i <= $rental->rating ? 'fas' : 'far' }} fa-star"></i>
                                            @endfor
                                        </div>
                                    @else
                                        <button onclick="openReviewModal({{ $rental->id }}, '{{ $rental->car->nama_mobil }}')" class="px-3.5 py-1.5 text-xs font-semibold text-indigo-600 bg-indigo-50 hover:bg-indigo-100 dark:bg-indigo-950/30 dark:text-indigo-400 dark:hover:bg-indigo-950/50 rounded-xl transition-all shadow-sm">
                                            <i class="fas fa-star mr-1"></i> Beri Ulasan
                                        </button>
                                    @endif
                                @else
                                    <span class="text-slate-400 dark:text-slate-600">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center text-slate-500 dark:text-slate-400">
                                <div class="flex flex-col items-center gap-2">
                                    <i class="fas fa-file-invoice-dollar text-4xl text-slate-300 dark:text-slate-700"></i>
                                    <span>Anda belum pernah melakukan penyewaan.</span>
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

<!-- Modal Beri Ulasan -->
<div id="reviewModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm p-4">
    <div class="bg-white dark:bg-slate-900 max-w-md w-full rounded-3xl overflow-hidden border border-slate-200 dark:border-slate-800 shadow-2xl">
        <form id="reviewForm" method="POST" action="">
            @csrf
            <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center bg-slate-50 dark:bg-slate-950">
                <h3 class="font-bold text-slate-900 dark:text-white">Beri Ulasan</h3>
                <button type="button" onclick="closeReviewModal()" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="p-6 space-y-4">
                <p class="text-xs text-slate-500">Mobil: <span id="reviewCarName" class="font-bold text-slate-700 dark:text-slate-300"></span></p>
                
                <!-- Rating Select -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Rating Bintang</label>
                    <div class="flex items-center gap-2">
                        <input type="hidden" name="rating" id="ratingInput" value="5">
                        <div class="flex gap-1.5 text-2xl text-amber-400 cursor-pointer" id="starsContainer">
                            <i class="fas fa-star" data-value="1"></i>
                            <i class="fas fa-star" data-value="2"></i>
                            <i class="fas fa-star" data-value="3"></i>
                            <i class="fas fa-star" data-value="4"></i>
                            <i class="fas fa-star" data-value="5"></i>
                        </div>
                    </div>
                </div>

                <!-- Review Text -->
                <div class="space-y-2">
                    <label for="review" class="text-sm font-semibold text-slate-700 dark:text-slate-300">Komentar Ulasan</label>
                    <textarea name="review" id="review" rows="4" placeholder="Tuliskan pengalaman Anda menggunakan mobil ini..." class="w-full px-4 py-3 border border-slate-200 dark:border-slate-800 rounded-xl bg-slate-50 dark:bg-slate-950 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:focus:ring-indigo-500 transition-all text-sm"></textarea>
                </div>
            </div>
            <div class="px-6 py-4 bg-slate-50 dark:bg-slate-950 border-t border-slate-100 dark:border-slate-800 flex justify-end gap-3">
                <button type="button" onclick="closeReviewModal()" class="px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800">Batal</button>
                <button type="submit" class="px-4 py-2 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl">Kirim Ulasan</button>
            </div>
        </form>
    </div>
</div>


@endsection
