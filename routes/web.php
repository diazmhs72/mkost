<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenyewaController;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KostController;
use App\Http\Controllers\BookingController;
use App\Http\Middleware\RoleMiddleware;

// Route utama / landing
Route::get('/', [PenyewaController::class, 'home'])->name('home');

// Autentikasi
Auth::routes();

/* ------------------- PENYEWA ------------------- */
Route::middleware(['auth', RoleMiddleware::class . ':penyewa'])->group(function () {
    // TAMBAHKAN .where('id', '[0-9]+') UNTUK MEMASTIKAN {id} HANYA ANGKA
    Route::get('/kost/{id}', [PenyewaController::class, 'show'])->where('id', '[0-9]+')->name('kost.show');
    Route::get('/status-booking', [PenyewaController::class, 'status'])->name('penyewa.status');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
});

/* ------------------- PEMILIK ------------------- */
Route::middleware(['auth', RoleMiddleware::class . ':pemilik'])->group(function () {
    Route::get('/kostku', [KostController::class, 'pemilikIndex'])->name('pemilik.index');

    // Route untuk form tambah kost
    Route::get('/kost/create', [KostController::class, 'create'])->name('kost.create');
    Route::post('/kost', [KostController::class, 'store'])->name('kost.store');

    // Route untuk form edit kost
    Route::get('/kost/{kost}/edit', [KostController::class, 'edit'])->name('kost.edit');
    // Route untuk memproses update (gunakan PUT)
    Route::put('/kost/{kost}', [KostController::class, 'update'])->name('kost.update');

    // Route untuk menghapus kost (gunakan DELETE)
    Route::delete('/kost/{kost}', [KostController::class, 'destroy'])->name('kost.destroy');
});

/* ------------------- ADMIN ------------------- */
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', [AdminController::class, 'index'])->name('users');
    Route::put('/users/{user}', [AdminController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [AdminController::class, 'destroy'])->name('users.destroy');
});

Route::get('/index', [KostController::class, 'index'])->middleware(['auth', RoleMiddleware::class . ':penyewa'])->name('index');
