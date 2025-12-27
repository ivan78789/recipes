<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Recipe;

class RecipeCard extends Component
{
    public Recipe $recipe;

    public function __construct(Recipe $recipe)
    {
        $this->recipe = $recipe;
    }

    public function render()
    {
        return view('components.recipe-card');
    }
}

