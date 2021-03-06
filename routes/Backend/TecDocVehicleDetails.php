<?php

use App\Http\Controllers\Backend\TecDoc\VehicleDetails\VehicleDetailsAjaxController;
use App\Http\Controllers\Backend\TecDoc\VehicleDetails\VehicleDetailsController;
use Illuminate\Support\Facades\Route;

/**
 * All route names are prefixed with 'backend.vehicle-details'.
 */
Route::group(['prefix' => ''], function () {
    Route::post('vehicle-details/get', [VehicleDetailsAjaxController::class, 'get'])->name('ajax.vehicle-details.get');

    Route::post('vehicle-details/sync', [VehicleDetailsController::class, 'sync'])->name('vehicle-details.sync');
    Route::post('vehicle-details/sync-assets', [VehicleDetailsController::class, 'syncAssets'])->name('vehicle-details.sync-assets');
    Route::resource('vehicle-details', VehicleDetailsController::class);
});
