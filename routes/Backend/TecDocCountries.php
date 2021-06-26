<?php

use App\Http\Controllers\Backend\TecDoc\Country\CountryController;
use Illuminate\Support\Facades\Route;

/**
 * All route names are prefixed with 'admin.countries'.
 */
Route::group(['prefix' => ''], function () {
//    Route::post('countries/get', 'CountryDataController@get')->name('countries.get');
    Route::resource('countries', CountryController::class);
});
