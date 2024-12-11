<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EcommerceController;
use Illuminate\Support\Facades\Route;

Route::get('/', [EcommerceController::class, 'index'])->name('home');
// Halaman login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Proses login
Route::post('/login', [AuthController::class, 'processLogin'])->name('process.login');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Cek status sesi untuk auto-refresh AJAX
Route::get('/check-session', [AuthController::class, 'checkSession'])->name('check.session');

// Middleware untuk melindungi rute (hanya akses jika login)
Route::middleware(['custom.auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Manajemen Produk
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::put('/{product}', [ProductController::class, 'update'])->name('update');
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');
    });

    // Manajemen User
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
    });
});
