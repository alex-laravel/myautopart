<?php

use App\Http\Controllers\Backend\TecDoc\VehicleDetails\VehicleDetailsController;
use Illuminate\Support\Facades\Route;

/**
 * All route names are prefixed with 'admin.vehicle-details'.
 */
Route::group(['prefix' => ''], function () {
//    Route::post('vehicle-details/get', 'VehicleDetailsDataController@get')->name('vehicle-details.get');
    Route::resource('vehicle-details', VehicleDetailsController::class);
});
