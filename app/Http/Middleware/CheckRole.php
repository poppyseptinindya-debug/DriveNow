<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!$request->user()) {
            return redirect()->route('login');
        }

        if ($request->user()->role !== $role) {
            // If they try to access admin, redirect to customer dashboard with error
            if ($role === 'admin') {
                return redirect()->route('dashboard')->with('error', 'Akses ditolak! Halaman ini hanya untuk admin.');
            }
            return redirect('/')->with('error', 'Akses ditolak!');
        }

        return $next($request);
    }
}
