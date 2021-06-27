<?php

use App\Http\Controllers\Backend\TecDoc\BrandAddress\BrandAddressAjaxController;
use App\Http\Controllers\Backend\TecDoc\BrandAddress\BrandAddressController;
use Illuminate\Support\Facades\Route;

/**
 * All route names are prefixed with 'backend.brand-addresses'.
 */
Route::group(['prefix' => ''], function () {
    Route::post('brand-addresses/get', [BrandAddressAjaxController::class, 'get'])->name('ajax.brand-addresses.get');
    Route::resource('brand-addresses', BrandAddressController::class);
});
