<?php

use App\Http\Controllers\DaftarPoliController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\JadwalPeriksaController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PeriksaController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RiwayatPasienController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::resource('dashboard', DashboardController::class);
});

Route::middleware(['auth', 'role:dokter'])->group(function () {
    Route::resource('jadwal', JadwalPeriksaController::class);
    Route::resource('periksa', PeriksaController::class);
    Route::resource('riwayat', RiwayatPasienController::class);
    // web.php
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

});
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('dokter', DokterController::class);
    Route::resource('pasien', PasienController::class);
    Route::resource('poli', PoliController::class);
    Route::resource('obat', ObatController::class);
});
Route::middleware(['auth', 'role:pasien'])->group(function () {
    Route::resource('daftar-poli', DaftarPoliController::class);
});