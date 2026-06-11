<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Public routes (Guests & Logged in users)
Route::get('/', [DashboardController::class, 'index'])->name('home');
Route::get('/tentang', [DashboardController::class, 'about'])->name('tentang');
Route::get('/kontak', [DashboardController::class, 'contact'])->name('kontak');
Route::post('/kontak', [DashboardController::class, 'submitContact'])->name('kontak.submit');

// Customer / General Auth routes
Route::middleware(['auth'])->group(function () {
    // Customer Dashboard after login
    Route::get('/dashboard', [DashboardController::class, 'customerDashboard'])->name('dashboard');

    // Car catalog & detail for customer
    Route::get('/cars', [CarController::class, 'catalog'])->name('cars.catalog');
    Route::get('/cars/{car}', [CarController::class, 'customerShow'])->name('cars.show');

    // Live search JSON API
    Route::get('/api/cars/search', [CarController::class, 'searchApi'])->name('api.cars.search');

    // Rentals booking workflow
    Route::get('/rentals/create', [RentalController::class, 'create'])->name('rentals.create');
    Route::post('/rentals', [RentalController::class, 'store'])->name('rentals.store');
    Route::get('/rentals/history', [RentalController::class, 'history'])->name('rentals.history');
    Route::post('/rentals/{rental}/cancel', [RentalController::class, 'cancel'])->name('rentals.cancel');
    Route::post('/rentals/{rental}/review', [RentalController::class, 'submitReview'])->name('rentals.review');

    // Profile Edit routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin group with prefix and middleware check
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Customer accounts list
    Route::get('/customers', [AdminController::class, 'customers'])->name('admin.customers.index');

    // CRUD Cars (Admin)
    Route::get('/cars', [CarController::class, 'index'])->name('admin.cars.index');
    Route::get('/cars/create', [CarController::class, 'create'])->name('admin.cars.create');
    Route::post('/cars', [CarController::class, 'store'])->name('admin.cars.store');
    Route::get('/cars/{car}/edit', [CarController::class, 'edit'])->name('admin.cars.edit');
    Route::put('/cars/{car}', [CarController::class, 'update'])->name('admin.cars.update');
    Route::delete('/cars/{car}', [CarController::class, 'destroy'])->name('admin.cars.destroy');

    // Rentals list & status changes (Admin)
    Route::get('/rentals', [RentalController::class, 'adminIndex'])->name('admin.rentals.index');
    Route::post('/rentals/{rental}/status', [RentalController::class, 'updateStatus'])->name('admin.rentals.updateStatus');
    Route::delete('/rentals/{rental}', [RentalController::class, 'destroy'])->name('admin.rentals.destroy');

    // Admin View Contacts
    Route::get('/contacts', [AdminController::class, 'contactsIndex'])->name('admin.contacts.index');
    Route::delete('/contacts/{contact}', [AdminController::class, 'destroyContact'])->name('admin.contacts.destroy');
});

require __DIR__.'/auth.php';
