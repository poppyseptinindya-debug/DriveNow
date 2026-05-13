<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CekAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah user sudah login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Cek apakah role user adalah 'admin'
        if (auth()->user()->role !== 'admin') {
            // Jika bukan admin, redirect ke dashboard dengan pesan error
            return redirect()->route('dashboard')->with('error', 'Akses ditolak! Halaman ini hanya untuk admin.');
        }

        return $next($request);
    }
}
