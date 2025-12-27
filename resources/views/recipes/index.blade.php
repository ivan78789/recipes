@extends('layouts.app')

@section('title', 'Рецепты')

@section('content')
    <div class="max-w-6xl mx-auto py-12 px-4">
        <h1 class="text-3xl font-bold mb-6">Все рецепты</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($recipes as $recipe)
                <article class="recipe-card p-4">
                    <h2 class="text-xl font-semibold mb-2">{{ $recipe->title }}</h2>
                    <p class="text-sm text-gray-600">{{ $recipe->description }}</p>
                    <div class="mt-4">
                        <a href="{{ route('recipes.show', $recipe) }}" class="text-red-600 font-medium">Открыть →</a>
                    </div>
                </article>
            @empty
                <p>Рецептов пока нет.</p>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $recipes->links() }}
        </div>
    </div>
@endsection
