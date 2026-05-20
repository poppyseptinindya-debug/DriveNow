<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TrackVisitor
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            // Jumlah kunjungan
            $count = session('visit_count', 0);
            $count++;
            session(['visit_count' => $count]);

            // Waktu pertama kunjungan
            if (!session('visit_first')) {
                session(['visit_first' => now()->format('d M Y, H:i:s')]);
            }

            // Waktu terakhir kunjungan
            session(['visit_last' => now()->format('d M Y, H:i:s')]);
        }

        return $next($request);
    }
}
