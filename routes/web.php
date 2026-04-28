<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\RentalController;

Route::get('/', [DashboardController::class, 'index']);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/cars', [CarController::class, 'index'])->name('cars.index');

Route::get('/rentals', [RentalController::class, 'index'])->name('rentals.index');

Route::get('/hitung/{a}/{b}', function ($a, $b) {
    return "Hasil penjumlahan {$a} + {$b} = " . ($a + $b);
});

Route::view('/tentang', 'tentang')->name('tentang');
