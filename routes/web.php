<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MonitorController;

Route::get('/', [MonitorController::class, 'index'])->name('monitor.index');
Route::post('/request/{ip_address}/comment', [MonitorController::class, 'updateComment'])->name('request.update.comment');
Route::post('/preferences', [MonitorController::class, 'updatePreferences'])->name('preferences.update');