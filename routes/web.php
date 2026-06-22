<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\Member\OrderController as MemberOrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public / Guest Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [GuestController::class, 'home'])->name('home');
Route::get('/paket-catering', [GuestController::class, 'packages'])->name('packages.index');
Route::get('/paket-catering/{package}', [GuestController::class, 'packageDetail'])->name('packages.show');
Route::get('/tentang-kami', [GuestController::class, 'about'])->name('about');

/*
|--------------------------------------------------------------------------
| Guest-only Auth Routes (Login & Register)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])
    ->name('google.login');

Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])
    ->name('google.callback');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Member Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'member'])->prefix('member')->name('member.')->group(function () {
    // Profile
    Route::get('/profil', [MemberOrderController::class, 'profile'])->name('profile');
    Route::put('/profil', [MemberOrderController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profil/password', [MemberOrderController::class, 'updatePassword'])->name('profile.password');

    // Orders
    Route::get('/pesanan', [MemberOrderController::class, 'index'])->name('orders.index');
    Route::get('/pesanan/buat/{package}', [MemberOrderController::class, 'create'])->name('orders.create');
    Route::post('/pesanan/buat/{package}', [MemberOrderController::class, 'store'])->name('orders.store');
    Route::get('/pesanan/{order}', [MemberOrderController::class, 'show'])->name('orders.show');
    Route::post('/pesanan/{order}/upload-bukti', [MemberOrderController::class, 'uploadPayment'])->name('orders.upload-payment');
    Route::post('/pesanan/{order}/batalkan', [MemberOrderController::class, 'cancel'])->name('orders.cancel');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/laporan', [AdminDashboardController::class, 'reports'])->name('reports');

    // Categories
    Route::resource('kategori', CategoryController::class)->parameters(['kategori' => 'category'])->names('categories');

    // Packages
    Route::resource('paket', PackageController::class)->parameters(['paket' => 'package'])->names('packages');

    // Orders
    Route::get('/pesanan', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/pesanan/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::put('/pesanan/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.update-status');

    // Payments
    Route::get('/pembayaran', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/pembayaran/{payment}', [PaymentController::class, 'show'])->name('payments.show');
    Route::put('/pembayaran/{payment}/verifikasi', [PaymentController::class, 'verify'])->name('payments.verify');

    // Users
    Route::resource('pengguna', UserController::class)->parameters(['pengguna' => 'user'])->names('users');
});
