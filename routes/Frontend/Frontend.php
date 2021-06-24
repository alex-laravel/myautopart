<?php

use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;

/**
 * Frontend Controllers
 */

Route::get('/', [HomeController::class, 'index'])->name('index');
