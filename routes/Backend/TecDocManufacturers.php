<?php

use App\Http\Controllers\Backend\TecDoc\Manufacturer\ManufacturerAjaxController;
use App\Http\Controllers\Backend\TecDoc\Manufacturer\ManufacturerController;
use Illuminate\Support\Facades\Route;

/**
 * All route names are prefixed with 'backend.manufacturers'.
 */
Route::group(['prefix' => ''], function () {
    Route::post('manufacturers/get', [ManufacturerAjaxController::class, 'get'])->name('ajax.manufacturers.get');

    Route::get('manufacturers/sync', [ManufacturerController::class, 'sync'])->name('manufacturers.sync');
    Route::resource('manufacturers', ManufacturerController::class);
});
