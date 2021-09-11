<?php

use App\Http\Controllers\Backend\TecDoc\DirectArticleDetails\DirectArticleDetailsAjaxController;
use App\Http\Controllers\Backend\TecDoc\DirectArticleDetails\DirectArticleDetailsController;
use Illuminate\Support\Facades\Route;

/**
 * All route names are prefixed with 'backend.direct-article-details'.
 */
Route::group(['prefix' => ''], function () {
    Route::post('direct-article-details/get', [DirectArticleDetailsAjaxController::class, 'get'])->name('ajax.direct-article-details.get');

    Route::post('direct-article-details/sync', [DirectArticleDetailsController::class, 'sync'])->name('direct-article-details.sync');
    Route::post('direct-article-details/sync-assets', [DirectArticleDetailsController::class, 'syncAssets'])->name('direct-article-details.sync-assets');
    Route::resource('direct-article-details', DirectArticleDetailsController::class);
});
