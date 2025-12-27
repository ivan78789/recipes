<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        $query = Recipe::with(['category', 'reviews', 'user']);

        // Поиск
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('body', 'like', "%{$search}%");
            });
        }

        // Фильтр по категории
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }
        
        // Загружаем связи для оптимизации
        $query->with(['category', 'reviews', 'user']);

        $recipes = $query->latest()->paginate(12);
        $categories = Category::all();

        return view('recipes.index', compact('recipes', 'categories'));
    }

    public function popular()
    {
        $recipes = Recipe::with(['category', 'reviews', 'user'])
            ->get()
            ->sortByDesc(function($recipe) {
                $avgRating = $recipe->reviews->avg('rating') ?? 0;
                $reviewCount = $recipe->reviews->count();
                // Сортируем по среднему рейтингу, при равном рейтинге - по количеству отзывов
                return $avgRating * 1000 + $reviewCount;
            })
            ->take(12)
            ->values();
        return view('recipes.popular', compact('recipes'));
    }

    public function favorites()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $recipes = Auth::user()->favorites()
            ->with(['category', 'reviews', 'user'])
            ->latest()
            ->paginate(12);
        return view('recipes.favorites', compact('recipes'));
    }

    public function category(Category $category)
    {
        $recipes = Recipe::where('category_id', $category->id)
            ->with(['category', 'reviews', 'user'])
            ->latest()
            ->paginate(12);
        return view('recipes.category', compact('recipes', 'category'));
    }

    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('recipes.add-recipes', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'body' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data['user_id'] = Auth::id();
        
        // Генерируем уникальный slug
        $baseSlug = Str::slug($data['title']);
        $slug = $baseSlug;
        $counter = 1;
        while (Recipe::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }
        $data['slug'] = $slug;

        // Загрузка изображения
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('recipes', 'public');
            $data['image'] = '/storage/' . $path;
        }

        $recipe = Recipe::create($data);

        return redirect()->route('recipes.show', $recipe);
    }

    public function show(Recipe $recipe)
    {
        $recipe->load(['category', 'reviews.user', 'user']);
        $isFavorite = Auth::check() && Auth::user()->favorites()->where('recipe_id', $recipe->id)->exists();
        return view('recipes.show', compact('recipe', 'isFavorite'));
    }

    public function edit(Recipe $recipe)
    {
        if ($recipe->user_id !== Auth::id()) {
            abort(403);
        }
        $categories = \App\Models\Category::all();
        return view('recipes.edit', compact('recipe', 'categories'));
    }

    public function update(Request $request, Recipe $recipe)
    {
        if ($recipe->user_id !== Auth::id()) {
            abort(403);
        }
        
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'body' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Генерируем уникальный slug только если название изменилось
        if ($recipe->title !== $data['title']) {
            $baseSlug = Str::slug($data['title']);
            $slug = $baseSlug;
            $counter = 1;
            while (Recipe::where('slug', $slug)->where('id', '!=', $recipe->id)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }
            $data['slug'] = $slug;
        }

        // Загрузка нового изображения
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('recipes', 'public');
            $data['image'] = '/storage/' . $path;
        }

        $recipe->update($data);

        return redirect()->route('recipes.show', $recipe);
    }

    public function destroy(Recipe $recipe)
    {
        if ($recipe->user_id !== Auth::id()) {
            abort(403);
        }
        $recipe->delete();
        return redirect()->route('recipes.index');
    }

    public function my()
    {
        $recipes = Recipe::where('user_id', Auth::id())
            ->with(['category', 'reviews', 'user'])
            ->latest()
            ->paginate(12);
        return view('recipes.my', compact('recipes'));
    }
}
