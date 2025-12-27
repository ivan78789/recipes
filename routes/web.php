<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\FavoriteController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('index');
});


// Рецепты
Route::prefix('recipes')->group(function () {
    // Публичные маршруты
    Route::get('/', [RecipeController::class, 'index'])->name('recipes.index');
    Route::get('/popular', [RecipeController::class, 'popular'])->name('recipes.popular');
    Route::get('/favorites', [RecipeController::class, 'favorites'])->name('recipes.favorites');
    Route::get('/category/{category:slug}', [RecipeController::class, 'category'])->name('recipes.category');
    Route::get('/{recipe:slug}', [RecipeController::class, 'show'])->name('recipes.show'); // Детальная страница
    
    // CRUD (только для авторизованных)
    Route::middleware('auth')->group(function () {
        Route::get('/create', [RecipeController::class, 'create'])->name('recipes.create');
        Route::post('/', [RecipeController::class, 'store'])->name('recipes.store');
        Route::get('/{recipe:slug}/edit', [RecipeController::class, 'edit'])->name('recipes.edit');
        Route::put('/{recipe:slug}', [RecipeController::class, 'update'])->name('recipes.update');
        Route::delete('/{recipe:slug}', [RecipeController::class, 'destroy'])->name('recipes.destroy');
        
        // Отзывы
        Route::post('/{recipe:slug}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
        Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
        
        // Оценки
        Route::post('/{recipe:slug}/rate', [RatingController::class, 'rate'])->name('recipes.rate');
        
        // Избранное
        Route::post('/{recipe:slug}/favorite', [FavoriteController::class, 'toggle'])->name('recipes.favorite.toggle');
    });
});

// Профиль и загрузка аватара
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/avatar', [ProfileController::class, 'avatar'])->name('profile.avatar');
    Route::get('/recipes/my', [RecipeController::class, 'my'])->name('recipes.my');
    Route::get('/reviews/my', [ReviewController::class, 'my'])->name('reviews.my');
    
    // Пароль пользователя
    Route::patch('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    
    // Удаление пользователя
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Email verification routes
Route::middleware('auth')->group(function () {
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('status', 'verification-link-sent');
    })->name('verification.send');
});

// Подключаем маршруты аутентификации (login, logout, register, password)
require __DIR__ . '/auth.php';
