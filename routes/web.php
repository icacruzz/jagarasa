<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Publik
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/produk/{slug}', [HomeController::class, 'show'])->name('produk.show');

// Autentikasi Admin
Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Halaman Admin (Prefix /admin, Dilindungi Middleware Auth)
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/laporan-penjualan', [\App\Http\Controllers\Admin\DashboardController::class, 'salesReport'])->name('reports.sales');

    Route::resource('produk', ProductController::class)
        ->names([
            'index'   => 'products.index',
            'create'  => 'products.create',
            'store'   => 'products.store',
            'show'    => 'products.show',
            'edit'    => 'products.edit',
            'update'  => 'products.update',
            'destroy' => 'products.destroy',
        ])
        ->parameters([
            'produk' => 'product',
        ]);
});

