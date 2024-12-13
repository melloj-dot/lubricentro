<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InterventionController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard',[DashboardController::class, 'dashboard_stats'])->name('dashboard');

    Route::resource('/cliente', CustomerController::class,['except' => ['show']]);
    Route::resource('/vehiculo', VehicleController::class,['except' => ['show']]);
    Route::resource('/intervencion', InterventionController::class,['except' => ['show']]);
    Route::resource('/producto', ProductController::class);
    Route::resource('/venta', SaleController::class,['only' => ['index', 'create', 'store']]);
    Route::resource('/stock', StockController::class,['only' => ['index', 'create', 'store','destroy']]);

    Route::get('/intervencion-pdf/{patent}',[InterventionController::class, 'dumppdf'])->name('intervencion.dumppdf');

});

require __DIR__.'/auth.php';
