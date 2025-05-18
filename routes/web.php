<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\EventController as AdminEvent;
use App\Http\Controllers\Admin\BuyerController as AdminBuyer;
use App\Http\Controllers\Admin\PurchaseController as AdminPurchase;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/register', [AuthController::class, 'store'])->name('auth.store');
Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.authenticate');
Route::delete('/logout', [AuthController::class, 'logout'])->name('auth.logout');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
  ->name('admin.')
  ->middleware(['auth', 'can:admin'])
  ->group(function () {
    Route::get('/', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::resource('events', AdminEvent::class);
    Route::resource('buyers', AdminBuyer::class)->except('show');
    Route::get('purchases', [AdminPurchase::class, 'index'])->name('purchases.index');
    Route::post('events/{event}/purchase', [AdminPurchase::class, 'store'])->name('purchases.store');
    Route::put('purchases/{purchase}', [AdminPurchase::class, 'update'])->name('purchases.update');
    Route::delete('purchases/{purchase}', [AdminPurchase::class, 'destroy'])->name('purchases.destroy');
  });
