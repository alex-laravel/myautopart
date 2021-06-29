<?php

use App\Http\Controllers\Auto\AutoController;
use App\Http\Controllers\Auto\GarageController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;

/**
 * Frontend Controllers
 */

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/auto/{manufacturer}', [AutoController::class, 'manufacturer']);
Route::get('/auto/{manufacturer}/{model}', [AutoController::class, 'model']);
Route::get('/auto/{manufacturer}/{model}/{vehicle}', [AutoController::class, 'vehicle']);
Route::get('/garage/{manufacturerId}/{modelSeriesId}/{vehicleId}/add', [GarageController::class, 'vehicleAdd'])->name('garage.vehicle.add');
Route::get('/garage/{manufacturerId}/{modelSeriesId}/{vehicleId}/activate', [GarageController::class, 'vehicleActivate'])->name('garage.vehicle.activate');
Route::get('/garage/{manufacturerId}/{modelSeriesId}/{vehicleId}/delete', [GarageController::class, 'vehicleDelete'])->name('garage.vehicle.delete');
