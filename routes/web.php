<?php

   use App\Http\Controllers\AdminController;
   use App\Http\Controllers\ContentController;
   use App\Http\Controllers\ProfileController;
   use Illuminate\Support\Facades\Route;

   Route::get('/', [ContentController::class, 'index'])->name('welcome');

   Route::get('/dashboard', function () {
       return view('dashboard');
   })->middleware(['auth', 'verified'])->name('dashboard');

   Route::middleware('auth')->group(function () {
       Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
       Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
       Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
   });

   Route::prefix('admin')->middleware('auth')->group(function () {
       Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
       Route::post('/content', [AdminController::class, 'storeContent'])->name('admin.storeContent');
       Route::delete('/content/{id}', [AdminController::class, 'destroyContent'])->name('admin.destroyContent');

       Route::get('/edit-authors', [AdminController::class, 'showAuthors'])->name('admin.editAuthors');
       Route::post('/authors', [AdminController::class, 'storeAuthor'])->name('admin.storeAuthor');
       Route::delete('/author/{id}', [AdminController::class, 'destroyAuthor'])->name('admin.destroyAuthor');

       Route::get('/edit-genres', [AdminController::class, 'showGenres'])->name('admin.editGenres');
       Route::post('/genres', [AdminController::class, 'storeGenre'])->name('admin.storeGenre');
       Route::delete('/genre/{id}', [AdminController::class, 'destroyGenre'])->name('admin.destroyGenre');

       Route::get('/edit-societies', [AdminController::class, 'showSocieties'])->name('admin.editSocieties');
       Route::post('/societies', [AdminController::class, 'storeSociety'])->name('admin.storeSociety');
       Route::delete('/society/{id}', [AdminController::class, 'destroySociety'])->name('admin.destroySociety');
   });

   require __DIR__.'/auth.php';