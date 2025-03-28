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

// Route admin dengan prefix '/admin'
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Manajemen kamar
    Route::get('/rooms', [RoomController::class, 'index'])->name('admin.rooms.index');
    Route::post('/rooms', [RoomController::class, 'store'])->name('admin.rooms.store');
    Route::put('/rooms/{id}', [RoomController::class, 'update'])->where('id', '[0-9]+')->name('admin.rooms.update');
    Route::delete('/rooms/{id}', [RoomController::class, 'destroy'])->where('id', '[0-9]+')->name('admin.rooms.destroy');

    // Manajemen reservasi
    Route::get('/reservations', [ReservationController::class, 'index'])->name('admin.reservations.index');
    Route::post('/reservations/{id}/accept', [ReservationController::class, 'accept'])->where('id', '[0-9]+')->name('admin.reservations.accept');
    Route::post('/reservations/{id}/reject', [ReservationController::class, 'reject'])->where('id', '[0-9]+')->name('admin.reservations.reject');
});

// Route untuk login admin


require __DIR__.'/auth.php';
