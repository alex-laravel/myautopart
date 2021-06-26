<?php

use App\Http\Controllers\Backend\TecDoc\Manufacturer\ManufacturerController;
use Illuminate\Support\Facades\Route;

/**
 * All route names are prefixed with 'admin.manufacturers'.
 */
Route::group(['prefix' => ''], function () {
//    Route::post('manufacturers/get', 'ManufacturerDataController@get')->name('manufacturers.get');
    Route::resource('manufacturers', ManufacturerController::class);
});
