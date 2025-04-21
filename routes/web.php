<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\UserController;



// Route untuk login
Route::middleware(['authentication'])->group(function(){
    Route::get('/login', [LoginController::class, 'show'])->name('login.show');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.process');
});
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');




// Route admin yang membutuhkan autentikasi
Route::middleware(['admin'])->group(function(){

    //Dashboard
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin'); //Dashboard

    //Akun Admin
    // Menampilkan daftar admin
    Route::get('/admin/accounts', [AdminController::class, 'index'])->name('admin.accounts');
    // Menambahkan admin baru
    Route::get('/admin/accounts/create', [AdminController::class, 'create'])->name('admin.accounts.create');
    Route::post('/admin/accounts', [AdminController::class, 'store'])->name('admin.accounts.store');
    // Mengedit admin
    // Route::put('/admin/accounts/{id_admin}', [AdminController::class, 'update'])->name('admin.accounts.update');


    // Kategori
    // Menampilkan daftar kategori
    Route::get('/admin/kategori', [KategoriController::class, 'index'])->name('admin.kategori');
    // Menambahkan kategori baru
    Route::post('/admin/kategori', [KategoriController::class, 'store'])->name('admin.kategori.store');
    // Mengedit kategori
    Route::put('/admin/kategori/{id}', [KategoriController::class, 'update'])->name('admin.kategori.update');
    // Menghapus kategori
    Route::delete('/admin/kategori/{id}', [KategoriController::class, 'destroy'])->name('admin.kategori.destroy');


    // User
    // Menampilkan daftar user
    Route::get('/admin/user', [UserController::class, 'index'])->name('admin.user');


    //Produk
    // Menampilkan daftar produk
    Route::get('/admin/produk', [ProdukController::class, 'index'])->name('admin.produk');
    // Menambahkan produk baru
    Route::post('/admin/produk', [ProdukController::class, 'store'])->name('admin.produk.store');
    // Mengedit produk
    Route::put('/admin/produk/{id}', [ProdukController::class, 'update'])->name('admin.produk.update');
    // Menghapus produk
    Route::delete('/admin/produk/{id}', [ProdukController::class, 'destroy'])->name('admin.produk.destroy');


    //Status
    // Menampilkan daftar produk
    Route::get('/admin/status', [StatusController::class, 'index'])->name('admin.status');
    // Menambahkan produk baru
    Route::post('/admin/status', [StatusController::class, 'store'])->name('admin.status.store');
    // Mengedit produk
    Route::put('/admin/status/{id}', [StatusController::class, 'update'])->name('admin.status.update');
    // Menghapus produk
    Route::delete('/admin/status/{id}', [StatusController::class, 'destroy'])->name('admin.status.destroy');

    //Pesanan
    // Menampilkan daftar pesanan
    Route::get('/admin/pesanan', [PesananController::class, 'index'])->name('admin.pesanan');
    // Mengupdate status pesanan
    Route::put('/admin/pesanan/{id}', [PesananController::class, 'update'])->name('admin.pesanan.update');


    // Profile
    Route::get('/admin/profile', [AdminController::class, 'show'])->name('admin.profile');
    Route::put('/admin/profile', [AdminController::class, 'update'])->name('admin.accounts.update');


});






