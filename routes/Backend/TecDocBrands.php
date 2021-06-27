<?php

use App\Http\Controllers\Backend\TecDoc\Brand\BrandAjaxController;
use App\Http\Controllers\Backend\TecDoc\Brand\BrandController;
use Illuminate\Support\Facades\Route;

/**
 * All route names are prefixed with 'backend.brands'.
 */
Route::group(['prefix' => ''], function () {
    Route::post('brands/get', [BrandAjaxController::class, 'get'])->name('ajax.brands.get');
    Route::resource('brands', BrandController::class);
});
