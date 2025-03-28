<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard menampilkan daftar hotel untuk user yang sudah login
Route::get('/dashboard', [HotelController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Group route yang hanya bisa diakses oleh user yang sudah login
Route::middleware(['auth'])->group(function () {

    // Profil user
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Hotel - Melihat daftar dan detail hotel + pencarian
    Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
    Route::get('/hotels/search', [HotelController::class, 'search'])->name('hotels.search');
    Route::get('/hotels/{hotel}', [HotelController::class, 'show'])->name('hotels.show');

    // Reservasi - Melihat, membuat, dan membatalkan reservasi
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::delete('/reservations/{reservation}/cancel', [ReservationController::class, 'cancel'])->name('reservations.cancel');
});

// Autentikasi Breeze
require __DIR__.'/auth.php';
