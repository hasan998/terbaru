<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginAdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [UserController::class, 'index'])->name('beranda.index');
Route::get('/menu', [UserController::class, 'menu'])->name('menu.index');
Route::get('/tentang-kami', [UserController::class, 'about'])->name('tentangKami.index');

Auth::routes();
Route::middleware('auth')->group(function() {
    // ! Detail Menu
    Route::get('/menu-detail/{produk_id}', [UserController::class, 'menuDetail'])->name('menuDetail.index');
    // ! Halaman Keranjang
    Route::get('/keranjang', [UserController::class, 'cart'])->name('keranjang.index');
    Route::delete('/keranjang/{pesanandetail_id}/delete', [UserController::class, 'cartDelete'])->name('cart.destroy');
    Route::post('/keranjang/checkOut', [UserController::class, 'checkOut'])->name('cart.checkOut');
    // ! Halaman Riwayat Pembelian
    Route::get('/riwayat-pembelian', [UserController::class, 'riwayat'])->name('riwayat.index');
    Route::get('/riwayat-pembelian/{pesanandetail_id}', [UserController::class, 'riwayatDetail'])->name('riwayatDetail.index');
    // ! Halaman Profile
    Route::get('/profile', [UserController::class, 'profil'])->name('profil.index');
    Route::post('/profile/{user_id}', [UserController::class, 'profilUpdate'])->name('profilUpdate.index');
    // ! User Pesan Produk
    Route::post('/produk/{produk_id}/add-to-cart', [UserController::class, 'pesan'])->name('pesan.store');
});


Route::middleware('auth:admin')->group(function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard.index');
        // ! Halaman Produk
        Route::get('/produk', [AdminController::class, 'produk'])->name('produk.index');
        // ! Halaman Tambah Produk
        Route::get('/produk/create', [AdminController::class, 'create'])->name('produk.create');
        Route::post('/produk/create', [AdminController::class, 'store'])->name('produk.store');
        // ! Halaman Ubah Produk
        Route::get('/produk/{produk_id}/edit', [AdminController::class, 'edit'])->name('produk.edit');
        Route::post('/produk/{produk_id}/edit', [AdminController::class, 'update'])->name('produk.update');
        // ! Hapus Produk
        Route::delete('/produk/{produk_id}/delete', [AdminController::class, 'destroy'])->name('produk.destroy');
        // ! Halaman User
        Route::get('/user', [AdminController::class, 'user'])->name('user.index');
        Route::delete('/user/{user_id}/delete', [AdminController::class, 'destroyUser'])->name('user.destroy');
        // ! Halaman Pesanan
        Route::get('/pesanan', [AdminController::class, 'pesanan'])->name('pesanan.index');
        Route::get('/pesanan/{pesanan_id}/edit', [AdminController::class, 'pesananEdit'])->name('pesanan.edit');
        Route::post('/pesanan/{pesanan_id}', [AdminController::class, 'pesananUpdate'])->name('pesanan.update');
        // ! Halaman Pesanan Detail
        Route::get('/pesanan-detail', [AdminController::class, 'pesananDetail'])->name('pesananDetail.index');

    });
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('login',[LoginAdminController::class,'index'])->name('adminlogin.index');
    Route::post('login',[LoginAdminController::class,'login'])->name('adminlogin.login');
    Route::post('logout', [LoginAdminController::class, 'logout'])->name('admin.logout');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
