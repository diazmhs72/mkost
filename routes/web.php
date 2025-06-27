<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenyewaController;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KostController;
use App\Http\Controllers\BookingController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;

// Route utama / landing
Route::get('/', [PenyewaController::class, 'home'])->name('home');

// Autentikasi
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);


/* ------------------- PENYEWA ------------------- */
Route::middleware(['auth', RoleMiddleware::class . ':penyewa'])->group(function () {
    Route::get('/kost/{id}', [PenyewaController::class, 'show'])->where('id', '[0-9]+')->name('kost.show');
    Route::get('/status-booking', [PenyewaController::class, 'status'])->name('penyewa.status');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
});
Route::get('/index', [KostController::class, 'index'])->middleware(['auth', RoleMiddleware::class . ':penyewa'])->name('index');


/* ------------------- PEMILIK ------------------- */
Route::middleware(['auth', RoleMiddleware::class . ':pemilik'])->group(function () {
    Route::get('/kostku', [KostController::class, 'pemilikIndex'])->name('pemilik.index');

    // Tambahkan rute untuk orderan di sini
    Route::get('/orderan', [PemilikController::class, 'orderan'])->name('pemilik.orderan');

    // Route untuk form tambah kost
    Route::get('/kost/create', [KostController::class, 'create'])->name('kost.create');
    Route::post('/kost', [KostController::class, 'store'])->name('kost.store');

    // Route untuk form edit kost
    Route::get('/kost/{kost}/edit', [KostController::class, 'edit'])->name('kost.edit');
    Route::put('/kost/{kost}', [KostController::class, 'update'])->name('kost.update');
    Route::delete('/kost/{kost}', [KostController::class, 'destroy'])->name('kost.destroy');

    // Rute untuk menyetujui dan menolak booking
    Route::post('/booking/{booking}/setujui', [BookingController::class, 'setujui'])->name('booking.setujui');
    Route::post('/booking/{booking}/tolak', [BookingController::class, 'tolak'])->name('booking.tolak');
});

/* ------------------- ADMIN ------------------- */
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', [AdminController::class, 'index'])->name('users');
    Route::put('/users/{user}', [AdminController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [AdminController::class, 'destroy'])->name('users.destroy');
});

// profile
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
