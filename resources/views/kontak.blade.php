@extends('layouts.app')

@section('title', 'DriveNow | Kotak Saran')

@section('content')
<div class="max-w-4xl mx-auto space-y-8 animate-fade-in">
    <!-- Hero Header -->
    <div class="text-center space-y-3">
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700 dark:bg-indigo-950/40 dark:text-indigo-400">
            📩 Kotak Saran Pelanggan
        </span>
        <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white sm:text-4xl">Kirim Saran & Masukan</h1>
        <p class="text-slate-500 dark:text-slate-400 max-w-xl mx-auto text-sm sm:text-base">Saran dan kritik Anda sangat berharga bagi kami untuk terus meningkatkan kualitas layanan DriveNow.</p>
    </div>

    <!-- Contact Grid -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-8">
        <!-- Direct Contacts -->
        <div class="md:col-span-2 space-y-6">
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 shadow-sm space-y-6">
                <h3 class="font-bold text-slate-800 dark:text-white text-lg">Hubungi Kami</h3>
                
                <div class="space-y-4">
                    <div class="flex items-start gap-4">
                        <div class="h-10 w-10 flex items-center justify-center rounded-xl bg-indigo-50 dark:bg-indigo-950/40 text-indigo-600 dark:text-indigo-400 text-base flex-shrink-0">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 font-semibold uppercase">Email Kami</p>
                            <p class="text-sm font-semibold text-slate-700 dark:text-slate-300">support@drivenow.com</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="h-10 w-10 flex items-center justify-center rounded-xl bg-indigo-50 dark:bg-indigo-950/40 text-indigo-600 dark:text-indigo-400 text-base flex-shrink-0">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 font-semibold uppercase">Nomor Telepon</p>
                            <p class="text-sm font-semibold text-slate-700 dark:text-slate-300">(021) 1234-5678</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="h-10 w-10 flex items-center justify-center rounded-xl bg-indigo-50 dark:bg-indigo-950/40 text-indigo-600 dark:text-indigo-400 text-base flex-shrink-0">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 font-semibold uppercase">Alamat Kantor</p>
                            <p class="text-sm text-slate-700 dark:text-slate-300 leading-relaxed">Jl. Raya Darmo No. 45, Wonokromo, Surabaya, Jawa Timur 60241</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="md:col-span-3">
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 sm:p-8 shadow-sm">
                <h3 class="font-bold text-slate-800 dark:text-white text-lg mb-6">Kirimkan Saran atau Masukan Anda</h3>
                <form id="contactForm" class="space-y-4">
                    <div class="space-y-1">
                        <label for="name" class="text-xs font-semibold text-slate-600 dark:text-slate-400">Nama Lengkap</label>
                        <input type="text" id="name" placeholder="Masukkan nama lengkap" class="w-full px-4 py-3 border border-slate-200 dark:border-slate-800 rounded-xl bg-slate-50 dark:bg-slate-950 focus:outline-none focus:border-indigo-500 text-sm" required>
                    </div>
                    <div class="space-y-1">
                        <label for="email" class="text-xs font-semibold text-slate-600 dark:text-slate-400">Alamat Email</label>
                        <input type="email" id="email" placeholder="Masukkan alamat email aktif" class="w-full px-4 py-3 border border-slate-200 dark:border-slate-800 rounded-xl bg-slate-50 dark:bg-slate-950 focus:outline-none focus:border-indigo-500 text-sm" required>
                    </div>
                    <div class="space-y-1">
                        <label for="message" class="text-xs font-semibold text-slate-600 dark:text-slate-400">Isi Saran / Kritik</label>
                        <textarea id="message" rows="4" placeholder="Tuliskan saran, kritik, atau masukan Anda..." class="w-full px-4 py-3 border border-slate-200 dark:border-slate-800 rounded-xl bg-slate-50 dark:bg-slate-950 focus:outline-none focus:border-indigo-500 text-sm" required></textarea>
                    </div>
                    <button type="submit" class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl transition-all shadow-md shadow-indigo-500/10">
                        Kirimkan Saran
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
