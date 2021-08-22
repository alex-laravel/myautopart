<?php

use App\Http\Controllers\Frontend\Account\AccountController;
use Illuminate\Support\Facades\Route;

/**
 * Frontend Account Controllers
 */

Route::name('account.')->prefix('account')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AccountController::class, 'dashboard'])->name('dashboard');
    Route::get('/garage', [AccountController::class, 'garage'])->name('garage');
    Route::get('/orders', [AccountController::class, 'orders'])->name('orders');
    Route::get('/profile', [AccountController::class, 'profile'])->name('profile');
    Route::get('/password', [AccountController::class, 'password'])->name('password');
});
