<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomAuthenticatedSessionController;

Route::get('/', [ContentController::class, 'index'])->name('home');

Route::middleware('guest')->group(function () {
    Route::get('login', [CustomAuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [CustomAuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [CustomAuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::get('contents', [ContentController::class, 'index'])->name('contents.index'); 
    Route::get('contents/create', [ContentController::class, 'create'])->name('contents.create');
    Route::post('contents', [ContentController::class, 'store'])->name('contents.store');
    Route::get('contents/{content}/edit', [ContentController::class, 'edit'])->name('contents.edit')->where('content', '[0-9]+');
    Route::put('contents/{content}', [ContentController::class, 'update'])->name('contents.update')->where('content', '[0-9]+');
    Route::delete('contents/{content}', [ContentController::class, 'destroy'])->name('contents.destroy')->where('content', '[0-9]+');

    Route::get('/contents/{content}', [ContentController::class, 'show'])->name('contents.show')->where('content', '[0-9]+');

    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::post('/admin/authors', [AdminController::class, 'storeAuthor'])->name('admin.authors.store');
    Route::delete('/admin/authors/{author}', [AdminController::class, 'destroyAuthor'])->name('admin.authors.destroy');

    Route::post('/admin/genres', [AdminController::class, 'storeGenre'])->name('admin.genres.store');
    Route::delete('/admin/genres/{genre}', [AdminController::class, 'destroyGenre'])->name('admin.genres.destroy');

    Route::post('/admin/societies', [AdminController::class, 'storeSociety'])->name('admin.societies.store');
    Route::delete('/admin/societies/{society}', [AdminController::class, 'destroySociety'])->name('admin.societies.destroy');
});