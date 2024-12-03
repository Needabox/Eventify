<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfNotAuthenticated;

// Route::get('/', [EventController::class, 'index']);
// Route::get('detail-event/{id}', [EventController::class, 'show'])->name('detail-event');

Route::get('register', function () {
    return view('register');
});

Route::post('register-store', [UserController::class, 'register'])->name('register-store');

Route::middleware([RedirectIfNotAuthenticated::class])->group(function () {
    Route::get('/', [EventController::class, 'index']);
    Route::get('detail-event/{id}', [EventController::class, 'show'])->name('detail-event');
    Route::POST('register-event', [EventController::class, 'registerEvent'])->name('register-event');
    Route::get('detail-blog/{id}', [BlogController::class, 'show'])->name('blog');
});
