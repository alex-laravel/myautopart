<?php

use App\Http\Controllers\Auto\AutoController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;

/**
 * Frontend Controllers
 */

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/auto/{manufacturer}', [AutoController::class, 'manufacturer']);
Route::get('/auto/{manufacturer}/{model}', [AutoController::class, 'model']);
Route::get('/auto/{manufacturer}/{model}/{vehicle}', [AutoController::class, 'vehicle']);

//Route::get('/tecdoc/api/version', \App\Http\Controllers\TecDoc\TecDocApiVersionController::class);
//Route::get('/tecdoc/api/languages', \App\Http\Controllers\TecDoc\TecDocApiLanguagesController::class);
//Route::get('/tecdoc/api/countries', \App\Http\Controllers\TecDoc\TecDocApiCountriesController::class);
//Route::get('/tecdoc/api/country-groups', \App\Http\Controllers\TecDoc\TecDocApiCountryGroupsController::class);
//Route::get('/tecdoc/api/brands', \App\Http\Controllers\TecDoc\TecDocApiBrandsController::class);
//Route::get('/tecdoc/api/manufacturers', \App\Http\Controllers\TecDoc\TecDocApiManufacturersController::class);
//Route::get('/tecdoc/api/models', \App\Http\Controllers\TecDoc\TecDocApiModelSeriesController::class);
//Route::get('/tecdoc/api/vehicles', \App\Http\Controllers\TecDoc\TecDocApiVehiclesController::class);
//Route::get('/tecdoc/api/vehicle-details', \App\Http\Controllers\TecDoc\TecDocApiVehicleDetailsController::class);

Route::get('/garage/{manufacturerId}/{modelSeriesId}/{vehicleId}/add', [\App\Http\Controllers\Auto\GarageController::class, 'vehicleAdd'])->name('garage.vehicle.add');
Route::get('/garage/{manufacturerId}/{modelSeriesId}/{vehicleId}/activate', [\App\Http\Controllers\Auto\GarageController::class, 'vehicleActivate'])->name('garage.vehicle.activate');
Route::get('/garage/{manufacturerId}/{modelSeriesId}/{vehicleId}/delete', [\App\Http\Controllers\Auto\GarageController::class, 'vehicleDelete'])->name('garage.vehicle.delete');
