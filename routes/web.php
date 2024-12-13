<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InterventionController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::resource('/cliente', CustomerController::class,['except' => ['show']]);
    Route::resource('/vehiculo', VehicleController::class,['except' => ['show']]);
    Route::resource('/intervencion', InterventionController::class,['except' => ['show']]);
    Route::resource('/producto', ProductController::class,['except' => ['show']]);
    Route::resource('/venta', SaleController::class,['except' => ['show']]);
    Route::resource('/stock', StockController::class,['except' => ['show']]);

});

require __DIR__.'/auth.php';
