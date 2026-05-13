<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Rental;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMobil = Car::count();
        $mobilTersedia = Car::where('status', 'Tersedia')->count();
        $mobilDisewa = Car::where('status', 'Disewa')->count();

        // Total penyewaan (admin lihat semua, customer lihat milik sendiri)
        if (auth()->check() && auth()->user()->role === 'admin') {
            $totalPenyewaan = Rental::count();
            $mobilPopuler = Car::latest()->take(6)->get();
        } else {
            $totalPenyewaan = Rental::where('user_id', auth()->id())->count();
            $mobilPopuler = Car::latest()->take(6)->get();
        }

        return view('dashboard', compact('totalMobil', 'mobilTersedia', 'mobilDisewa', 'totalPenyewaan', 'mobilPopuler'));
    }
}
