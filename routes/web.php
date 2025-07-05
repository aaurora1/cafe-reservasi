<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\PembayaranController;

// ===============================
// HALAMAN UMUM
// ===============================
Route::get('/', function () {
    return view('home.home');
})->name('home');

Route::get('/menu', function () {
    return view('menu.menu');
})->name('menu');

// ===============================
// AUTH
// ===============================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ===============================
// HALAMAN SETELAH LOGIN
// ===============================
Route::get('/landing', function () {
    return view('home.home');
})->middleware('auth')->name('landing');

// ===============================
// RESERVASI (WAJIB LOGIN)
// ===============================
Route::middleware(['auth'])->group(function () {

    // 1. Form reservasi
    Route::get('/reservasi', [ReservasiController::class, 'create'])->name('reservasi.form');

    // 2. Simpan reservasi
    Route::post('/reservasi', [ReservasiController::class, 'store'])->name('reservasi.store');

    // 3. Halaman pembayaran (langsung dari form reservasi)
    Route::get('/reservasi/pembayaran/{id}', [ReservasiController::class, 'pembayaran'])->name('transaksi.pembayaran');

    // 4. Redirect sukses
    Route::get('/reservasi/berhasil', function () {
        return view('reservasi.berhasil');
    })->name('reservasi.berhasil');

    // 5. Dashboard user
    Route::get('/dashboard', [ReservasiController::class, 'index'])->name('dashboard');

    // 6. Edit/Update/Hapus reservasi
    Route::get('/dashboard/edit/{id}', [ReservasiController::class, 'edit'])->name('dashboard.edit');
    Route::put('/dashboard/update/{id}', [ReservasiController::class, 'update'])->name('dashboard.update');
    Route::delete('/dashboard/hapus/{id}', [ReservasiController::class, 'destroy'])->name('dashboard.destroy');

    // ===============================
    // PEMBAYARAN (User)
    // ===============================
    Route::get('/pembayaran/{id}', [PembayaranController::class, 'show'])->name('pembayaran.show');
    Route::post('/pembayaran/proses', [PembayaranController::class, 'proses'])->name('pembayaran.proses');
    Route::get('/riwayat/{id}', [PembayaranController::class, 'cekbayar'])->name('transaksi.riwayat');
    Route::get('/transaksi/detail/{id}', [PembayaranController::class, 'detail'])->name('transaksi.detail');
});

// ===============================
// CALLBACK MIDTRANS (WAJIB DI LUAR MIDDLEWARE)
// ===============================
Route::post('/midtrans/callback', [PembayaranController::class, 'handle'])->name('midtrans.callback');
