<?php

use App\Http\Controllers\Backend\TecDoc\Language\LanguageController;
use Illuminate\Support\Facades\Route;

/**
 * All route names are prefixed with 'admin.languages'.
 */
Route::group(['prefix' => ''], function () {
//    Route::post('languages/get', 'LanguageDataController@get')->name('languages.get');
    Route::resource('languages', LanguageController::class);
});
