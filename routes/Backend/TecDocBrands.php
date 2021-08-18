<?php

use App\Http\Controllers\Backend\TecDoc\Brand\BrandAjaxController;
use App\Http\Controllers\Backend\TecDoc\Brand\BrandController;
use Illuminate\Support\Facades\Route;

/**
 * All route names are prefixed with 'backend.brands'.
 */
Route::group(['prefix' => ''], function () {
    Route::post('brands/get', [BrandAjaxController::class, 'get'])->name('ajax.brands.get');

    Route::post('brands/sync', [BrandController::class, 'sync'])->name('brands.sync');
    Route::post('brands/sync-assets', [BrandController::class, 'syncAssets'])->name('brands.sync-assets');
    Route::resource('brands', BrandController::class);
});
