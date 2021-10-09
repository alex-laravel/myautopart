<?php

use App\Http\Controllers\Backend\TecDoc\DirectArticleAnalogs\DirectArticleAnalogsAjaxController;
use App\Http\Controllers\Backend\TecDoc\DirectArticleAnalogs\DirectArticleAnalogsController;
use Illuminate\Support\Facades\Route;

/**
 * All route names are prefixed with 'backend.direct-article-analogs'.
 */
Route::group(['prefix' => ''], function () {
    Route::post('direct-article-analogs/get', [DirectArticleAnalogsAjaxController::class, 'get'])->name('ajax.direct-article-analogs.get');

    Route::post('direct-article-analogs/sync', [DirectArticleAnalogsController::class, 'sync'])->name('direct-article-analogs.sync');
    Route::resource('direct-article-analogs', DirectArticleAnalogsController::class);
});
