<?php

use App\Http\Controllers\Backend\TecDoc\DirectArticle\DirectArticleAjaxController;
use App\Http\Controllers\Backend\TecDoc\DirectArticle\DirectArticleController;
use Illuminate\Support\Facades\Route;

/**
 * All route names are prefixed with 'backend.direct-articles'.
 */
Route::group(['prefix' => ''], function () {
    Route::post('direct-articles/get', [DirectArticleAjaxController::class, 'get'])->name('ajax.direct-articles.get');

    Route::post('direct-articles/sync', [DirectArticleController::class, 'sync'])->name('direct-articles.sync');
    Route::resource('direct-articles', DirectArticleController::class);
});
