<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Recipe $recipe)
    {
        $data = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $user = Auth::user();
        
        // Проверяем, есть ли уже отзыв от этого пользователя
        $existingReview = Review::where('recipe_id', $recipe->id)
            ->where('user_id', $user->id)
            ->first();

        if ($existingReview) {
            // Обновляем существующий отзыв
            $existingReview->update($data);
            return back()->with('status', 'review-updated');
        }

        $data['user_id'] = $user->id;
        $data['recipe_id'] = $recipe->id;

        Review::create($data);

        return back()->with('status', 'review-created');
    }

    public function edit(Review $review)
    {
        if ($review->user_id !== Auth::id()) {
            abort(403);
        }
        return view('reviews.edit', compact('review'));
    }

    public function update(Request $request, Review $review)
    {
        if ($review->user_id !== Auth::id()) {
            abort(403);
        }

        $data = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $review->update($data);

        return redirect()->route('recipes.show', $review->recipe)->with('status', 'review-updated');
    }

    public function destroy(Review $review)
    {
        if ($review->user_id !== Auth::id()) {
            abort(403);
        }
        $review->delete();
        return back()->with('status', 'review-deleted');
    }

    public function my()
    {
        $reviews = Review::where('user_id', Auth::id())->latest()->paginate(12);
        return view('reviews.my', compact('reviews'));
    }
}
