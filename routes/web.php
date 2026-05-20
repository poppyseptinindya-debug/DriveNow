<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PreferenceController;
use App\Http\Controllers\VisitController;

// Halaman publik (tanpa login)
Route::get('/', [DashboardController::class, 'index']);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::view('/tentang', 'tentang')->name('tentang');
Route::view('/kontak', 'kontak')->name('kontak');

// ROUTE YANG BISA AKSES SEMUA USER YANG LOGIN (termasuk customer)
Route::middleware(['auth'])->group(function () {
    Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
    Route::get('/cars/{car}', [CarController::class, 'show'])->name('cars.show');
    Route::get('/rentals', [RentalController::class, 'index'])->name('rentals.index');
});

// ROUTE YANG HANYA BISA AKSES ADMIN (CREATE, EDIT, UPDATE, DELETE, STORE)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/cars/create', [CarController::class, 'create'])->name('cars.create');
    Route::post('/cars', [CarController::class, 'store'])->name('cars.store');
    Route::get('/cars/{car}/edit', [CarController::class, 'edit'])->name('cars.edit');
    Route::put('/cars/{car}', [CarController::class, 'update'])->name('cars.update');
    Route::delete('/cars/{car}', [CarController::class, 'destroy'])->name('cars.destroy');

    // Admin Dashboard
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

Route::get('/api/cuaca', [WeatherController::class, 'fetch'])->name('weather.fetch');
Route::get('/cuaca', function () {
    return redirect()->route('dashboard');
});

Route::get('/search', [SearchController::class, 'index'])->name('search.index');
Route::get('/api/search', [SearchController::class, 'search'])->name('search.api');

Route::middleware(['auth'])->group(function () {
Route::get('/preferensi', [PreferenceController::class, 'index'])->name('preferences.index');
Route::post('/preferensi/simpan', [PreferenceController::class, 'save'])->name('preferences.save');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/kunjungan', [VisitController::class, 'index'])->name('visits.index');
    Route::delete('/kunjungan/reset', [VisitController::class, 'reset'])->name('visits.reset');
});

require __DIR__.'/auth.php';
