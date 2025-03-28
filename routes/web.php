<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;

Route::get('/', function () {
   return view('welcome');
});
Route::get('/dashboard', function () {
   return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile',[ProfileController::class,'destroy'])->name('profile.destroy');
  
   // Our resource routes
   Route::resource('roles', RoleController::class);
   Route::resource('users', UserController::class);
   Route::resource('products', ProductController::class);
});

Route::get('/hotels/{id}', [HotelController::class, 'show']); // Detail hotel
Route::post('/reservations', [ReservationController::class, 'store'])->middleware('auth');

Route::middleware(['auth', 'admin'])->group(function () {
   Route::get('/admin/dashboard', function () { return view('admin.dashboard'); });
   Route::get('/admin/rooms', [RoomController::class, 'index']);
   Route::post('/admin/rooms', [RoomController::class, 'store']);
   Route::put('/admin/rooms/{id}', [RoomController::class, 'update']);
   Route::delete('/admin/rooms/{id}', [RoomController::class, 'destroy']);
   Route::get('/admin/reservations', [ReservationController::class, 'index']);
   Route::post('/admin/reservations/{id}/accept', [ReservationController::class, 'accept']);
   Route::post('/admin/reservations/{id}/reject', [ReservationController::class, 'reject']);
});
require __DIR__.'/auth.php';