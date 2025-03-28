<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Auth\AdminLoginController;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Dashboard utama (hanya untuk pengguna yang sudah login & terverifikasi)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route dengan middleware 'auth' (hanya untuk pengguna yang sudah login)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Resource routes
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
});

// Route untuk hotel & reservasi (beberapa membutuhkan autentikasi)
Route::get('/hotels/{id}', [HotelController::class, 'show'])->where('id', '[0-9]+')->name('hotels.show'); // Detail hotel
Route::post('/reservations', [ReservationController::class, 'store'])->middleware('auth')->name('reservations.store');




require __DIR__.'/auth.php';
