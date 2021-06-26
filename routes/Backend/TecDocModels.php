<?php

use App\Http\Controllers\Backend\TecDoc\Model\ModelController;
use Illuminate\Support\Facades\Route;

/**
 * All route names are prefixed with 'admin.models'.
 */
Route::group(['prefix' => ''], function () {
//    Route::post('models/get', 'ModelDataController@get')->name('models.get');
    Route::resource('models', ModelController::class);
});
