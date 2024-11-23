<?php

use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfNotAuthenticated;

// Route::get('/', [EventController::class, 'index']);
// Route::get('detail-event/{id}', [EventController::class, 'show'])->name('detail-event');

Route::middleware([RedirectIfNotAuthenticated::class])->group(function () {
    Route::get('/', [EventController::class, 'index']);
    Route::get('detail-event/{id}', [EventController::class, 'show'])->name('detail-event');
    Route::POST('register-event', [EventController::class, 'registerEvent'])->name('register-event');
});
