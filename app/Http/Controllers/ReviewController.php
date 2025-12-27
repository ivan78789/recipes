<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Recipe $recipe)
    {
        $data = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        $data['user_id'] = $request->user()?->id;
        $data['recipe_id'] = $recipe->id;

        Review::create($data);

        return back();
    }

    public function destroy(Recipe $recipe, Review $review)
    {
        $review->delete();
        return back();
    }
}
