@extends('layouts.app')

@section('title', 'DriveNow | Masuk Akun')

@section('content')
<div class="max-w-md mx-auto py-12 animate-fade-in">
    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 sm:p-8 shadow-lg space-y-6">
        <!-- Header -->
        <div class="text-center space-y-2">
            <h2 class="text-2xl font-extrabold text-slate-900 dark:text-white">Selamat Datang Kembali</h2>
            <p class="text-xs text-slate-500 dark:text-slate-400">Silakan masuk ke akun Anda untuk menyewa mobil terbaik.</p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="p-3 text-sm text-indigo-800 bg-indigo-50 dark:bg-indigo-950/30 dark:text-indigo-400 rounded-xl border border-indigo-100 dark:border-indigo-900/50">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- Email Address -->
            <div class="space-y-1">
                <label for="email" class="text-xs font-semibold text-slate-600 dark:text-slate-400">Alamat Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-3 border border-slate-200 dark:border-slate-800 rounded-xl bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:focus:ring-indigo-500 transition-all text-sm @error('email') border-rose-500 @enderror" required autofocus autocomplete="username">
                @error('email')
                    <p class="text-xs text-rose-500 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="space-y-1">
                <div class="flex justify-between items-center">
                    <label for="password" class="text-xs font-semibold text-slate-600 dark:text-slate-400">Kata Sandi</label>
                </div>
                <input type="password" id="password" name="password" class="w-full px-4 py-3 border border-slate-200 dark:border-slate-800 rounded-xl bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:focus:ring-indigo-500 transition-all text-sm @error('password') border-rose-500 @enderror" required autocomplete="current-password">
                @error('password')
                    <p class="text-xs text-rose-500 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 dark:bg-slate-950 dark:border-slate-800">
                <label for="remember_me" class="ml-2 text-xs text-slate-600 dark:text-slate-400 font-medium">Ingat Saya</label>
            </div>

            <!-- Action Button -->
            <button type="submit" class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl transition-all shadow-md shadow-indigo-600/10">
                Masuk ke Akun
            </button>
        </form>

        <div class="text-center pt-2 border-t border-slate-100 dark:border-slate-800/80">
            <p class="text-xs text-slate-500">Belum memiliki akun? <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300 font-bold">Daftar Sekarang</a></p>
        </div>
    </div>
</div>
@endsection
