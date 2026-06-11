@extends('layouts.app')

@section('title', 'DriveNow | Tentang Kami')

@section('content')
<div class="max-w-4xl mx-auto space-y-8 animate-fade-in">
    <!-- Hero Header -->
    <div class="text-center space-y-3">
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700 dark:bg-indigo-950/40 dark:text-indigo-400">
            🚙 Profil Perusahaan
        </span>
        <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white sm:text-4xl">Tentang DriveNow</h1>
        <p class="text-slate-500 dark:text-slate-400 max-w-xl mx-auto text-sm sm:text-base">Kenali lebih dekat platform penyedia sewa mobil terpercaya pilihan Anda.</p>
    </div>

    <!-- Vision & Mission -->
    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 sm:p-8 shadow-sm space-y-6">
        <div class="space-y-4">
            <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                <i class="fas fa-bullseye text-indigo-600 dark:text-indigo-400"></i> Visi & Misi Perusahaan
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                <div class="p-5 bg-slate-50 dark:bg-slate-950 rounded-2xl border border-slate-100 dark:border-slate-800">
                    <h3 class="font-bold text-indigo-600 dark:text-indigo-400 text-sm uppercase">Visi Kami</h3>
                    <p class="text-slate-600 dark:text-slate-300 text-sm mt-2 leading-relaxed">
                        Menjadi penyedia layanan transportasi mandiri nomor satu di Indonesia yang mengedepankan integrasi teknologi untuk memberikan kemudahan bagi semua pelanggan.
                    </p>
                </div>
                <div class="p-5 bg-slate-50 dark:bg-slate-950 rounded-2xl border border-slate-100 dark:border-slate-800">
                    <h3 class="font-bold text-indigo-600 dark:text-indigo-400 text-sm uppercase">Misi Kami</h3>
                    <ul class="list-disc list-inside text-slate-600 dark:text-slate-300 text-sm mt-2 space-y-1.5 leading-relaxed">
                        <li>Menjamin kualitas kebersihan dan performa mesin unit mobil.</li>
                        <li>Proses pemesanan dan verifikasi yang transparan.</li>
                        <li>Dukungan customer service 24 jam penuh.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Corporate Features -->
        <div class="pt-6 border-t border-slate-100 dark:border-slate-800 space-y-4">
            <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                <i class="fas fa-award text-indigo-600 dark:text-indigo-400"></i> Mengapa Memilih DriveNow?
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 pt-2">
                <div class="text-center p-4">
                    <div class="h-12 w-12 rounded-2xl bg-indigo-50 dark:bg-indigo-950/40 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-xl mx-auto mb-3 shadow-sm">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                    <h4 class="font-bold text-slate-800 dark:text-white text-sm">Harga Terbaik</h4>
                    <p class="text-xs text-slate-500 mt-1 dark:text-slate-400">Harga rental sewa bersaing tanpa adanya biaya tersembunyi.</p>
                </div>
                <div class="text-center p-4">
                    <div class="h-12 w-12 rounded-2xl bg-indigo-50 dark:bg-indigo-950/40 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-xl mx-auto mb-3 shadow-sm">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h4 class="font-bold text-slate-800 dark:text-white text-sm">Perjalanan Aman</h4>
                    <p class="text-xs text-slate-500 mt-1 dark:text-slate-400">Unit diasuransikan penuh dan dirawat berkala secara resmi.</p>
                </div>
                <div class="text-center p-4">
                    <div class="h-12 w-12 rounded-2xl bg-indigo-50 dark:bg-indigo-950/40 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-xl mx-auto mb-3 shadow-sm">
                        <i class="fas fa-business-time"></i>
                    </div>
                    <h4 class="font-bold text-slate-800 dark:text-white text-sm">Kemudahan Akses</h4>
                    <p class="text-xs text-slate-500 mt-1 dark:text-slate-400">Pesan secara online via website kapan saja dan di mana saja.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
