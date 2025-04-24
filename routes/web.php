<?php

use App\Http\Controllers\BuyerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PurchaseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dahboard');
});

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('events', EventController::class);
Route::resource('buyers', BuyerController::class)->except(['show']);
Route::get('purchases', [PurchaseController::class, 'index'])->name('purchases.index');
Route::post('events/{event}/purchase', [PurchaseController::class, 'store'])->name('purchases.store');
Route::put('purchases/{purchase}', [PurchaseController::class, 'update'])->name('purchases.update');
Route::delete('purchases/{purchase}', [PurchaseController::class, 'destroy'])->name('purchases.destroy');
