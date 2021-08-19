<?php

use App\Http\Controllers\Frontend\Auto\AutoController;
use App\Http\Controllers\Frontend\AutoPart\AutoPartController;
use App\Http\Controllers\Auto\GarageController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;

/**
 * Frontend Home Controllers
 */

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/auto/{manufacturer}', [AutoController::class, 'manufacturer']);
Route::get('/auto/{manufacturer}/{model}', [AutoController::class, 'model']);
Route::get('/auto/{manufacturer}/{model}/{vehicle}', [AutoController::class, 'vehicle']);
Route::get('/parts/{manufacturer}/{model}/{vehicle}', [AutoPartController::class, 'index'])->name('parts.index');
Route::get('/parts/by-brand/{brandId}/', [AutoPartController::class, 'byBrand'])->name('parts.brand');

Route::get('/garage/{manufacturerId}/{modelSeriesId}/{vehicleId}/activate', [GarageController::class, 'vehicleActivate'])->name('garage.vehicle.activate');
Route::get('/garage/{manufacturerId}/{modelSeriesId}/{vehicleId}/delete', [GarageController::class, 'vehicleDelete'])->name('garage.vehicle.delete');
