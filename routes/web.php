<?php

use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.dashboard');
});

Route::get('/user', [UserController::class, 'index'])->name('user.index');

Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');

Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');

Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
Route::get('/penjualan/tambah', [PenjualanController::class, 'create'])->name('penjualan.create');
Route::post('/penjualan/simpan', [PenjualanController::class, 'store'])->name('penjualan.store');
Route::post('/penjualan/bayar{id}', [PenjualanController::class, 'bayar'])->name('penjualan.bayar');
Route::get('/penjualan/cetak{id}', [PenjualanController::class, 'cetak'])->name('penjualan.cetak');

Route::get('/detail_pesanan{id}', [PesananController::class, 'index'])->name('detail_pesanan.index');
Route::get('/detail_pesanan/tambah{id}', [PesananController::class, 'create'])->name('detail_pesanan.tambah');
Route::post('/detail_pesanan/simpan{id}', [PesananController::class, 'store'])->name('detail_pesanan.simpan');
