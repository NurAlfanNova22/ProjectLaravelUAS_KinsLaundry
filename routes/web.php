<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\LaporanController;

// Halaman Default
Route::get('/', function () {
    return view('user.dashboard');
});

// Halaman dashboard user
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');
});

// Rute Dashboard Admin (dengan middleware auth)
Route::get('/admin', function () {
    return view('admin.admin');
})->name('admin.dashboard')->middleware('auth');

// Rute Login dan Logout
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Form tambah pesanan
Route::get('/pesanan/create', [PesananController::class, 'create'])->name('pesanan.create');

// Simpan pesanan
Route::post('/pesanan/store', [PesananController::class, 'store'])->name('pesanan.store');

Route::get('/pesanan/show/{pesanan}', [PesananController::class, 'show'])->name('admin.show');

Route::get('/admin', [PesananController::class, 'create'])->name('admin.dashboard');
Route::post('/pesanan/store', [PesananController::class, 'store'])->name('pesanan.store');

Route::get('/admin/pesanan', [PesananController::class, 'index'])->name('admin.pesanan');
Route::post('/admin/pesanan/{id}/update', [PesananController::class, 'updateStatus'])->name('admin.pesanan.update');

// Menampilkan halaman login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Menangani proses login (POST)
Route::post('/login', [AuthController::class, 'login']);

Route::get('/admin/pesanan', [PesananController::class, 'index'])->name('admin.pesanan');
Route::get('/admin/pesanan/{id}/show', [PesananController::class, 'show'])->name('admin.pesanan.show');
Route::get('/admin/pesanan/{id}/edit', [PesananController::class, 'edit'])->name('admin.pesanan.edit');
Route::put('/admin/pesanan/{id}', [PesananController::class, 'update'])->name('admin.pesanan.update');
Route::delete('/admin/pesanan/{id}', [PesananController::class, 'destroy'])->name('admin.pesanan.destroy');
Route::get('/admin/pesanan', [PesananController::class, 'index'])->name('admin.pesanan');
Route::put('/admin/pesanan/{id}', [PesananController::class, 'updateStatus'])->name('admin.pesanan.update');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/admin/laporan', [LaporanController::class, 'index'])->name('admin.laporan');
Route::get('/admin/laporan/print', [LaporanController::class, 'print'])->name('admin.laporan.print');