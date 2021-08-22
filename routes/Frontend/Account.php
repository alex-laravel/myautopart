<?php

use App\Http\Controllers\Frontend\Account\AccountController;
use Illuminate\Support\Facades\Route;

/**
 * Frontend Account Controllers
 */

Route::get('/account/dashboard', [AccountController::class, 'dashboard'])->name('account.dashboard');
Route::get('/account/garage', [AccountController::class, 'garage'])->name('account.garage');
Route::get('/account/orders', [AccountController::class, 'orders'])->name('account.orders');
Route::get('/account/profile', [AccountController::class, 'profile'])->name('account.profile');
Route::get('/account/password', [AccountController::class, 'password'])->name('account.password');
