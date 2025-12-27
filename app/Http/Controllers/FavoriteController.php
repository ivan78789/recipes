<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggle(Request $request, Recipe $recipe)
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        if (! $user) {
            return redirect()->route('login');
        }

        if ($user->favorites()->where('recipe_id', $recipe->id)->exists()) {
            $user->favorites()->detach($recipe->id);
            if ($request->wantsJson()) {
                return response()->json(['status' => 'removed']);
            }
            return back()->with('status', 'favorite-removed');
        }

        $user->favorites()->attach($recipe->id);
        if ($request->wantsJson()) {
            return response()->json(['status' => 'added']);
        }
        return back()->with('status', 'favorite-added');
    }

    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $recipes = $user->favorites()->latest()->paginate(12);
        return view('recipes.favorites', compact('recipes'));
    }
}
