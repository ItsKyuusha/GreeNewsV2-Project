<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\BeritaController;
use App\Http\Controllers\User\TanamanController;
use App\Http\Controllers\User\ForumController;
use App\Http\Controllers\User\KalkulatorController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\BeritaController as AdminBerita;
use App\Http\Controllers\Admin\TanamanController as AdminTanaman;
use App\Http\Controllers\Admin\UserController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [DashboardController::class, 'index'])->name('user.dashboard');
Route::get('/berita', [BeritaController::class, 'index'])->name('user.berita');
Route::get('/tanaman', [TanamanController::class, 'index'])->name('user.tanaman');
Route::get('/kalkulator', [KalkulatorController::class, 'index'])->name('user.kalkulator');
Route::post('/kalkulator/hitung', [KalkulatorController::class, 'hitung'])->name('user.kalkulator.hitung');
Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('user.berita.show');
Route::get('/tanaman/{id}', [TanamanController::class, 'show'])->name('user.tanaman.show');

// Forum (wajib login user biasa)
Route::middleware(['auth', 'auth.user'])->group(function () {
    Route::get('/forum', [ForumController::class, 'index'])->name('user.forum');
});

Route::middleware(['auth', 'auth.admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard');

    // Berita
    Route::resource('/berita', AdminBerita::class)->names('admin.berita');

    // Tanaman
    Route::resource('/tanaman', AdminTanaman::class)->names('admin.tanaman');
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});
