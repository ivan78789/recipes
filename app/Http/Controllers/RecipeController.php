<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::latest()->paginate(12);
        return view('recipes.index', compact('recipes'));
    }

    public function popular()
    {
        $recipes = Recipe::take(12)->get();
        return view('recipes.popular', compact('recipes'));
    }

    public function favorites()
    {
        // placeholder
        $recipes = Recipe::take(12)->get();
        return view('recipes.favorites', compact('recipes'));
    }

    public function create()
    {
        return view('recipes.add-recipes');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'body' => 'required|string',
        ]);

        $data['user_id'] = Auth::id();

        $recipe = Recipe::create($data);

        return redirect()->route('recipes.show', $recipe);
    }

    public function show(Recipe $recipe)
    {
        return view('recipes.show', compact('recipe'));
    }

    public function edit(Recipe $recipe)
    {
        return view('recipes.edit', compact('recipe'));
    }

    public function update(Request $request, Recipe $recipe)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'body' => 'required|string',
        ]);

        $recipe->update($data);

        return redirect()->route('recipes.show', $recipe);
    }

    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
        return redirect()->route('recipes.index');
    }

    public function my()
    {
        $recipes = Recipe::where('user_id', Auth::id())->latest()->paginate(12);
        return view('recipes.my', compact('recipes'));
    }
}
