<?php

use App\Http\Controllers\Backend\TecDoc\BrandAddress\BrandAddressController;
use Illuminate\Support\Facades\Route;

/**
 * All route names are prefixed with 'admin.brand-addresses'.
 */
Route::group(['prefix' => ''], function () {
//    Route::post('brand-addresses/get', 'BrandAddressDataController@get')->name('brand-addresses.get');
    Route::resource('brand-addresses', BrandAddressController::class);
});
