<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('transaksi', TransaksiController::class)->except(['show']);
Route::resource('kategori', KategoriController::class)->except(['show']);