<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PeriksaController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\UserPeriksaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware(['auth', 'role:dokter'])->group(function () {
    // Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
    Route::resource('obat', ObatController::class);
    Route::resource('dokter/periksa', PeriksaController::class);
});
Route::middleware(['auth', 'role:pasien'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('pasien/periksa', [UserPeriksaController::class, 'index'])->name('pasien.periksa.index');
    Route::post('pasien//periksa', [UserPeriksaController::class, 'store'])->name('pasien.periksa.store');
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');
});
