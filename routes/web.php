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

Route::get('/user', [UserController::class, 'index']);

Route::get('/produk', [ProdukController::class, 'index']);

Route::get('/pelanggan', [PelangganController::class, 'index']);

Route::get('/penjualan', [PenjualanController::class, 'index']);
Route::get('/penjualan/tambah', [PenjualanController::class, 'create']);
Route::post('/penjualan/simpan', [PenjualanController::class, 'store']);
Route::get('/penjualan/{id}/bayar', [PenjualanController::class, 'bayar']);

Route::get('/detail_pesanan/{id}', [PesananController::class, 'index']);
Route::get('/detail_pesanan/{id}/tambah', [PesananController::class, 'create']);
Route::post('/detail_pesanan/{id}/simpan', [PesananController::class, 'store']);
