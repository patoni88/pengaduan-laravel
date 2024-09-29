<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\WhatsappController;


Route::get('/', function () {
    return view('auth/login');
});

Route::middleware(['auth', 'checkstatus'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
});

Route::middleware(['auth', 'checkstatus'])->group(function () {
    // Routes yang dapat diakses oleh admin
    Route::middleware(['checkadmin'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
        Route::get('/pengaduan/{id}', [PengaduanController::class, 'edit'])->name('pengaduan.edit');
        Route::get('/pengaduan/print/{id}', [PengaduanController::class, 'show'])->name('pengaduan.show');
        Route::put('/pengaduan/update/{id}', [PengaduanController::class, 'update'])->name('pengaduan.update');
        Route::delete('/pengaduan/{id}', [PengaduanController::class, 'destroy'])->name('pengaduan.destroy');

        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');

        Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');

        Route::get('/whatsapp', [WhatsAppController::class, 'index'])->name('whatsapp.index');

        Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
        Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
        Route::delete('/contact/{id}', [ContactController::class, 'destroy'])->name('contact.destroy');

        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::post('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
    });

    // Routes yang dapat diakses oleh admin dan pengguna desa
    Route::middleware(['checkstatus'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
        Route::get('/pengaduan/{id}', [PengaduanController::class, 'edit'])->name('pengaduan.edit');
        Route::get('/pengaduan/print/{id}', [PengaduanController::class, 'show'])->name('pengaduan.show');
        Route::put('/pengaduan/update/{id}', [PengaduanController::class, 'update'])->name('pengaduan.update');
        Route::delete('/pengaduan/{id}', [PengaduanController::class, 'destroy'])->name('pengaduan.destroy');

        Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');

        Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
        Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
        Route::delete('/contact/{id}', [ContactController::class, 'destroy'])->name('contact.destroy');
    });
});

require __DIR__.'/auth.php';

