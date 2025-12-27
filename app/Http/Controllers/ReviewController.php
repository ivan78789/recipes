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
            'comment' => 'nullable|string',
        ]);

        $data['user_id'] = Auth::id();
        $data['recipe_id'] = $recipe->id ?? $recipe->getKey();

        Review::create($data);

        return back();
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return back();
    }

    public function my()
    {
        $reviews = Review::where('user_id', Auth::id())->latest()->paginate(12);
        return view('reviews.my', compact('reviews'));
    }
}
