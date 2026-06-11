@extends('layouts.app')

@section('title', 'DriveNow | Daftar Akun')

@section('content')
<div class="max-w-md mx-auto py-8 animate-fade-in">
    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 sm:p-8 shadow-lg space-y-6">
        <!-- Header -->
        <div class="text-center space-y-2">
            <h2 class="text-2xl font-extrabold text-slate-900 dark:text-white">Daftar Akun Baru</h2>
            <p class="text-xs text-slate-500 dark:text-slate-400">Buat akun Anda sekarang untuk menikmati sewa mobil yang fleksibel.</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <!-- Name -->
            <div class="space-y-1">
                <label for="name" class="text-xs font-semibold text-slate-600 dark:text-slate-400">Nama Lengkap</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" class="w-full px-4 py-3 border border-slate-200 dark:border-slate-800 rounded-xl bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:focus:ring-indigo-500 transition-all text-sm @error('name') border-rose-500 @enderror" required autofocus autocomplete="name">
                @error('name')
                    <p class="text-xs text-rose-500 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="space-y-1">
                <label for="email" class="text-xs font-semibold text-slate-600 dark:text-slate-400">Alamat Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-3 border border-slate-200 dark:border-slate-800 rounded-xl bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:focus:ring-indigo-500 transition-all text-sm @error('email') border-rose-500 @enderror" required autocomplete="username">
                @error('email')
                    <p class="text-xs text-rose-500 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="space-y-1">
                <label for="password" class="text-xs font-semibold text-slate-600 dark:text-slate-400">Kata Sandi</label>
                <input type="password" id="password" name="password" class="w-full px-4 py-3 border border-slate-200 dark:border-slate-800 rounded-xl bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:focus:ring-indigo-500 transition-all text-sm @error('password') border-rose-500 @enderror" required autocomplete="new-password">
                @error('password')
                    <p class="text-xs text-rose-500 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="space-y-1">
                <label for="password_confirmation" class="text-xs font-semibold text-slate-600 dark:text-slate-400">Konfirmasi Kata Sandi</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-4 py-3 border border-slate-200 dark:border-slate-800 rounded-xl bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:focus:ring-indigo-500 transition-all text-sm" required autocomplete="new-password">
            </div>

            <!-- Action Button -->
            <button type="submit" class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl transition-all shadow-md shadow-indigo-600/10">
                Daftar Akun Baru
            </button>
        </form>

        <div class="text-center pt-2 border-t border-slate-100 dark:border-slate-800/80">
            <p class="text-xs text-slate-500">Sudah memiliki akun? <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300 font-bold">Masuk Sekarang</a></p>
        </div>
    </div>
</div>
@endsection
