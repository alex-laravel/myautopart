<?php

use App\Http\Controllers\Backend\TecDoc\Model\ModelAjaxController;
use App\Http\Controllers\Backend\TecDoc\Model\ModelController;
use Illuminate\Support\Facades\Route;

/**
 * All route names are prefixed with 'backend.models'.
 */
Route::group(['prefix' => ''], function () {
    Route::post('models/get', [ModelAjaxController::class, 'get'])->name('ajax.models.get');
    Route::resource('models', ModelController::class);
});
