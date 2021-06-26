<?php

use App\Http\Controllers\Backend\TecDoc\CountryGroup\CountryGroupController;
use Illuminate\Support\Facades\Route;

/**
 * All route names are prefixed with 'admin.country-groups'.
 */
Route::group(['prefix' => ''], function () {
//    Route::post('country-groups/get', 'CountryGroupDataController@get')->name('country-groups.get');
    Route::resource('country-groups', CountryGroupController::class);
});
