@extends('layouts.app')

@section('title', 'DriveNow | Pengaturan Akun')

@section('content')
<div class="max-w-3xl mx-auto space-y-8 animate-fade-in">
    <!-- Header Block -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white sm:text-3xl">Pengaturan Akun</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Perbarui informasi profil dan kata sandi akun Anda.</p>
        </div>
        <a href="{{ Auth::user()->isAdmin() ? route('admin.dashboard') : route('dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-slate-700 bg-white dark:bg-slate-900 dark:text-slate-300 border border-slate-200 dark:border-slate-800 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800 transition-all shadow-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    @if (session('status') === 'profile-updated')
        <div class="p-4 text-sm text-emerald-800 bg-emerald-50 dark:bg-emerald-950/30 dark:text-emerald-400 rounded-2xl border border-emerald-100 dark:border-emerald-900/50 flex items-center gap-2">
            <i class="fas fa-check-circle"></i>
            <span>Informasi profil berhasil diperbarui!</span>
        </div>
    @endif

    @if (session('status') === 'password-updated')
        <div class="p-4 text-sm text-emerald-800 bg-emerald-50 dark:bg-emerald-950/30 dark:text-emerald-400 rounded-2xl border border-emerald-100 dark:border-emerald-900/50 flex items-center gap-2">
            <i class="fas fa-check-circle"></i>
            <span>Kata sandi Anda berhasil diperbarui!</span>
        </div>
    @endif

    <!-- Profile Info Card -->
    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 sm:p-8 shadow-sm space-y-6">
        <div>
            <h3 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                <i class="fas fa-id-card text-indigo-600 dark:text-indigo-400"></i> Informasi Profil
            </h3>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Perbarui nama lengkap dan alamat email akun Anda.</p>
        </div>

        <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
            @csrf
            @method('patch')

            <div class="space-y-1">
                <label for="name" class="text-xs font-semibold text-slate-600 dark:text-slate-400">Nama Lengkap</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="w-full px-4 py-3 border border-slate-200 dark:border-slate-800 rounded-xl bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:focus:ring-indigo-500 transition-all text-sm @error('name') border-rose-500 @enderror" required>
                @error('name')
                    <p class="text-xs text-rose-500 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-1">
                <label for="email" class="text-xs font-semibold text-slate-600 dark:text-slate-400">Alamat Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="w-full px-4 py-3 border border-slate-200 dark:border-slate-800 rounded-xl bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:focus:ring-indigo-500 transition-all text-sm @error('email') border-rose-500 @enderror" required>
                @error('email')
                    <p class="text-xs text-rose-500 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end pt-2">
                <button type="submit" class="px-6 py-2.5 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl transition-all shadow-md shadow-indigo-600/10">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    <!-- Password Card -->
    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 sm:p-8 shadow-sm space-y-6">
        <div>
            <h3 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                <i class="fas fa-lock text-indigo-600 dark:text-indigo-400"></i> Perbarui Kata Sandi
            </h3>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.</p>
        </div>

        <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
            @csrf
            @method('put')

            <div class="space-y-1">
                <label for="update_password_current_password" class="text-xs font-semibold text-slate-600 dark:text-slate-400">Kata Sandi Saat Ini</label>
                <input type="password" id="update_password_current_password" name="current_password" class="w-full px-4 py-3 border border-slate-200 dark:border-slate-800 rounded-xl bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:focus:ring-indigo-500 transition-all text-sm @error('current_password', 'updatePassword') border-rose-500 @enderror" required autocomplete="current-password">
                @error('current_password', 'updatePassword')
                    <p class="text-xs text-rose-500 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-1">
                <label for="update_password_password" class="text-xs font-semibold text-slate-600 dark:text-slate-400">Kata Sandi Baru</label>
                <input type="password" id="update_password_password" name="password" class="w-full px-4 py-3 border border-slate-200 dark:border-slate-800 rounded-xl bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:focus:ring-indigo-500 transition-all text-sm @error('password', 'updatePassword') border-rose-500 @enderror" required autocomplete="new-password">
                @error('password', 'updatePassword')
                    <p class="text-xs text-rose-500 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-1">
                <label for="update_password_password_confirmation" class="text-xs font-semibold text-slate-600 dark:text-slate-400">Konfirmasi Kata Sandi Baru</label>
                <input type="password" id="update_password_password_confirmation" name="password_confirmation" class="w-full px-4 py-3 border border-slate-200 dark:border-slate-800 rounded-xl bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:focus:ring-indigo-500 transition-all text-sm @error('password_confirmation', 'updatePassword') border-rose-500 @enderror" required autocomplete="new-password">
                @error('password_confirmation', 'updatePassword')
                    <p class="text-xs text-rose-500 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end pt-2">
                <button type="submit" class="px-6 py-2.5 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl transition-all shadow-md shadow-indigo-600/10">
                    Perbarui Kata Sandi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
