<?php

use App\Http\Controllers\Frontend\Auto\AutoController;
use App\Http\Controllers\Frontend\AutoPart\AutoPartController;
use App\Http\Controllers\Auto\GarageController;
use App\Http\Controllers\Frontend\Home\HomeController;
use Illuminate\Support\Facades\Route;

/**
 * Frontend Home Controllers
 */

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/auto', [AutoController::class, 'index'])->name('auto.index');
Route::get('/auto/{manufacturer}', [AutoController::class, 'manufacturer'])->name('auto.manufacturer');
Route::get('/auto/{manufacturer}/{model}', [AutoController::class, 'model'])->name('auto.model');
Route::get('/auto/{manufacturer}/{model}/{vehicle}', [AutoController::class, 'vehicle'])->name('auto.vehicle');

Route::get('/parts/auto', [AutoPartController::class, 'byVehicle'])->name('parts.vehicle');
Route::get('/parts/brand/{brandId}', [AutoPartController::class, 'byBrand'])->name('parts.brand');

Route::get('/garage/{manufacturerId}/{modelSeriesId}/{vehicleId}/activate', [GarageController::class, 'vehicleActivate'])->name('garage.vehicle.activate');
Route::get('/garage/{manufacturerId}/{modelSeriesId}/{vehicleId}/delete', [GarageController::class, 'vehicleDelete'])->name('garage.vehicle.delete');
