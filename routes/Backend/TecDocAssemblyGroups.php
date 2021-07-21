<?php

use App\Http\Controllers\Backend\TecDoc\AssemblyGroup\AssemblyGroupAjaxController;
use App\Http\Controllers\Backend\TecDoc\AssemblyGroup\AssemblyGroupController;
use Illuminate\Support\Facades\Route;

/**
 * All route names are prefixed with 'backend.assembly-groups'.
 */
Route::group(['prefix' => ''], function () {
    Route::post('assembly-groups/get', [AssemblyGroupAjaxController::class, 'get'])->name('ajax.assembly-groups.get');

    Route::post('assembly-groups/sync', [AssemblyGroupController::class, 'sync'])->name('assembly-groups.sync');
    Route::resource('assembly-groups', AssemblyGroupController::class);
});
