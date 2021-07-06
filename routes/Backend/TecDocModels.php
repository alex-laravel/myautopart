<?php

use App\Http\Controllers\Backend\TecDoc\Model\ModelAjaxController;
use App\Http\Controllers\Backend\TecDoc\Model\ModelController;
use Illuminate\Support\Facades\Route;

/**
 * All route names are prefixed with 'backend.models'.
 */
Route::group(['prefix' => ''], function () {
    Route::post('models/get', [ModelAjaxController::class, 'get'])->name('ajax.models.get');

    Route::post('models/sync', [ModelController::class, 'sync'])->name('models.sync');
    Route::resource('models', ModelController::class);
});
