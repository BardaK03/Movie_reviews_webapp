<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// web.php

Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movies.show');

Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');

Route::get('/', [MovieController::class, 'index'])->name('movies.index');




require __DIR__.'/auth.php';
