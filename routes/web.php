<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/dashboard/chart', [DashboardController::class, 'chart'])
        ->name('dashboard.chart');

    Route::resource('categories', CategoryController::class);

    Route::resource('products', ProductController::class);

    Route::resource('suppliers', SupplierController::class);

    Route::resource('barang-masuk', BarangMasukController::class)
        ->only([
            'index',
            'create',
            'store',
            'destroy'
        ]);

    Route::resource('barang-keluar', BarangKeluarController::class)
        ->only([
            'index',
            'create',
            'store',
            'destroy'
        ]);

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';