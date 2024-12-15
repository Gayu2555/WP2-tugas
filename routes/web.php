<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EcommerceController;
use Illuminate\Support\Facades\Route;

// === Rute untuk User (E-Commerce) ===


Route::get('/', [EcommerceController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::get('/ecommerce/register', [LoginController::class, 'showRegisterForm'])->name('ecommerce.register.view');
Route::post('/ecommerce/register', [LoginController::class, 'register'])->name('ecommerce.register');


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.view');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::post('/ecommerce/logout', [LoginController::class, 'logout'])->name('ecommerce.logout');




// === Rute untuk Admin Dashboard ===


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin'])->name('process.login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/check-session', [AuthController::class, 'checkSession'])->name('check.session');


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
