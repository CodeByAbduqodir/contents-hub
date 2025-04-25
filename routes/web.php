<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', [ContentController::class, 'index'])->name('home');

Route::get('/contents/{content}', [ContentController::class, 'show'])->name('contents.show');

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::resource('contents', ContentController::class)->except(['index', 'show']);
});