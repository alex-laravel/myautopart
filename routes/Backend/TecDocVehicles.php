<?php

use App\Http\Controllers\Backend\TecDoc\Vehicle\VehicleController;
use Illuminate\Support\Facades\Route;

/**
 * All route names are prefixed with 'admin.vehicles'.
 */
Route::group(['prefix' => ''], function () {
//    Route::post('vehicles/get', 'VehicleDataController@get')->name('vehicles.get');
    Route::resource('vehicles', VehicleController::class);
});
