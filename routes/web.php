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
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\RekomendasiController;
use App\Http\Controllers\ContactController;



// Route untuk login
Route::middleware(['authentication'])->group(function(){
    Route::get('/login', [LoginController::class, 'show'])->name('login.show');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.process');
});
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/about', function () {
    return view('about'); // Sesuaikan dengan nama view yang diinginkan
})->name('about');

Route::get('/contact', function () {
    return view('contact'); // Sesuaikan dengan nama view yang diinginkan
})->name('contact');

Route::get('/shop', function () {
    return view('shop'); // Sesuaikan dengan nama view yang diinginkan
})->name('shop');

Route::get('/', [RekomendasiController::class, 'index'])->name('home');

Route::get('/shop', [KatalogController::class, 'index'])->name('shop');
Route::get('/shop/filter/{id_kategori}', [KatalogController::class, 'filterByKategori'])->name('shop.filter');
Route::get('/shop/all', [KatalogController::class, 'allProduk']);



Route::get('/produk/{id}', [KatalogController::class, 'show'])->name('produk.detail');


Route::get('/checkout/cart', [CheckoutController::class, 'cartForm'])->name('checkout.cart.form');
Route::post('/checkout/cart/upload', [CheckoutController::class, 'cartUploadForm'])->name('checkout.cart.upload');
Route::post('/checkout/cart/process', [CheckoutController::class, 'prosesCart'])->name('checkout.cart.process');


Route::get('/checkout/{id_produk}', [CheckoutController::class, 'form'])->name('checkout.show');
Route::post('/checkout/simpan', [CheckoutController::class, 'simpanPesanan'])->name('checkout.simpan');
Route::get('/checkout/upload/{id}', [CheckoutController::class, 'uploadBukti'])->name('checkout.upload');
Route::post('/checkout/upload', [CheckoutController::class, 'simpanBukti'])->name('checkout.upload.simpan');

// Route login user
Route::get('/user/login', [UserAuthController::class, 'formLogin'])->name('user.login.form');
Route::post('/user/login', [UserAuthController::class, 'login'])->name('user.login');

// Route register user
Route::get('/user/register', [UserAuthController::class, 'formRegister'])->name('user.register.form');
Route::post('/user/register', [UserAuthController::class, 'register'])->name('user.register.store');

// Logout user
Route::post('/user/logout', [UserAuthController::class, 'logout'])->name('user.logout');

Route::middleware('auth:webuser')->group(function () {
    Route::get('/profil', [UserController::class, 'profil'])->name('profil');
});

Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('user.profile.edit');
Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('user.profile.update');
Route::get('/profile/orders', [UserController::class, 'riwayatPesanan'])->name('user.orders');
Route::delete('/profile/orders/{id}', [UserController::class, 'hapusPesanan'])->name('user.orders.delete');

Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
Route::post('/keranjang/tambah/{id_produk}', [KeranjangController::class, 'tambah'])->name('keranjang.tambah');
Route::delete('/keranjang/{id}', [KeranjangController::class, 'hapus'])->name('keranjang.hapus');


Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');
























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






