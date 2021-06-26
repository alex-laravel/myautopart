<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
 * Auth Routes
 */
Route::group(['as' => 'auth.'], function () {
    includeRouteFiles(__DIR__.'/Auth/');
});

/*
 * Backend Routes
 */
Route::group(['as' => 'backend.', 'prefix' => 'admin'], function () {
    includeRouteFiles(__DIR__.'/Backend/');
});

/*
 * Frontend Routes
 */
Route::group(['as' => 'frontend.'], function () {
    includeRouteFiles(__DIR__.'/Frontend/');
});

/*
 * Locale Routes
 */
Route::group(['as' => 'locale.'], function () {
    includeRouteFiles(__DIR__.'/Locale/');
});
