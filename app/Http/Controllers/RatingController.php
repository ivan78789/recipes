<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function rate(Request $request, Recipe $recipe)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $user = Auth::user();
        
        // Проверяем, есть ли уже отзыв от этого пользователя
        $review = Review::where('recipe_id', $recipe->id)
            ->where('user_id', $user->id)
            ->first();

        if ($review) {
            // Обновляем существующий отзыв
            $review->update(['rating' => $request->rating]);
        } else {
            // Создаем новый отзыв только с оценкой
            Review::create([
                'recipe_id' => $recipe->id,
                'user_id' => $user->id,
                'rating' => $request->rating,
                'comment' => null,
            ]);
        }

        return back()->with('status', 'rating-updated');
    }
}
