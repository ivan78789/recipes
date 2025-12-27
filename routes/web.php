<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

// Recipes
Route::get('/recipes/popular', [RecipeController::class, 'popular'])->name('recipes.popular');
Route::get('/recipes/favorites', [RecipeController::class, 'favorites'])->name('recipes.favorites');
Route::resource('recipes', RecipeController::class);

// Reviews (nested)
Route::post('recipes/{recipe}/reviews', [ReviewController::class, 'store'])->name('recipes.reviews.store');
Route::delete('recipes/{recipe}/reviews/{review}', [ReviewController::class, 'destroy'])->name('recipes.reviews.destroy');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
