@extends('layouts.app')

@section('title', 'Рецепты')

@section('content')
    <div class="max-w-6xl mx-auto py-12 px-4">
        <h1 class="text-3xl font-bold mb-6">Все рецепты</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($recipes as $recipe)
                <article class="recipe-card p-4 flex flex-col justify-between h-full">
                    <div>
                        <h2 class="text-xl font-semibold mb-2">{{ $recipe->title }}</h2>
                        <p class="text-sm text-gray-600">{{ $recipe->description }}</p>
                    </div>

                    <div class="mt-4 flex items-center justify-between">
                        <a href="{{ route('recipes.show', $recipe) }}" class="text-red-600 font-medium">Открыть →</a>

                        @auth
                            @php
                                $isFav = Auth::user()->favorites()->where('recipe_id', $recipe->id)->exists();
                            @endphp
                            <form action="{{ route('recipes.favorite.toggle', $recipe) }}" method="POST">
                                @csrf
                                <button type="submit" title="Избранное" class="p-2 rounded-full hover:bg-red-50 transition-colors">
                                    @if($isFav)
                                        <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 6.01 4.01 4 6.5 4c1.74 0 3.41.81 4.5 2.09C12.09 4.81 13.76 4 15.5 4 17.99 4 20 6.01 20 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    @endif
                                </button>
                            </form>
                        @endauth
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
