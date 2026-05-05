<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\RentalController;

Route::get('/', [DashboardController::class, 'index']);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('cars', CarController::class);

Route::get('/rentals', [RentalController::class, 'index'])->name('rentals.index');

Route::view('/tentang', 'tentang')->name('tentang');
Route::view('/kontak', 'kontak')->name('kontak');

Route::get('/hitung/{a}/{b}', function ($a, $b) {
    return "Hasil penjumlahan " . $a . " + " . $b . " = " . ($a + $b);
});
