<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('albums.index');
});


Route::get('/albums', [AlbumController::class, 'index'])
    ->name('albums.index');


Route::middleware('auth')->group(function () {
    Route::resource('albums', AlbumController::class)
        ->except(['index']);


    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/albums/fetch', [AlbumController::class, 'fetch'])
    ->name('albums.fetch');

require __DIR__.'/auth.php';

