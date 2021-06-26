<?php

use App\Http\Controllers\Backend\TecDoc\Brand\BrandController;
use Illuminate\Support\Facades\Route;

/**
 * All route names are prefixed with 'admin.brands'.
 */
Route::group(['prefix' => ''], function () {
//    Route::post('brands/get', 'BrandDataController@get')->name('brands.get');
    Route::resource('brands', BrandController::class);
});
