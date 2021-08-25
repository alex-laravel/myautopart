<?php

use App\Http\Controllers\Frontend\AssemblyGroup\AssemblyGroupController;
use Illuminate\Support\Facades\Route;

/**
 * Frontend AssemblyGroup Controllers
 */

Route::get('/assemblies/{assemblyGroupId}', [AssemblyGroupController::class, 'index'])->name('assemblies.index');
