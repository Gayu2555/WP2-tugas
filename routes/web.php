<?php

use App\Http\Controllers\AuthController; // Untuk Admin
use App\Http\Controllers\LoginController; // Untuk User
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EcommerceController;
use Illuminate\Support\Facades\Route;

// === Rute untuk User (E-Commerce) ===

// Halaman utama e-commerce
Route::get('/', [EcommerceController::class, 'index'])->name('home');

// Registrasi user
Route::get('/ecommerce/register', [LoginController::class, 'showRegisterForm'])->name('ecommerce.register.view');
Route::post('/ecommerce/register', [LoginController::class, 'register'])->name('ecommerce.register');

// Login user
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.view');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Logout user
Route::post('/ecommerce/logout', [LoginController::class, 'logout'])->name('ecommerce.logout');

// Middleware untuk melindungi rute user e-commerce (jika ada fitur khusus setelah login)


// === Rute untuk Admin Dashboard ===

// Halaman login admin
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin'])->name('process.login');

// Logout admin
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Cek status sesi untuk auto-refresh AJAX (khusus admin)
Route::get('/check-session', [AuthController::class, 'checkSession'])->name('check.session');

// Middleware untuk melindungi rute admin
Route::middleware(['custom.auth'])->group(function () {
    // Dashboard admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Manajemen Produk (admin)
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::put('/{product}', [ProductController::class, 'update'])->name('update');
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');
    });

    // Manajemen User (admin)
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
    });
});
