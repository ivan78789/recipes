@extends('layouts.app')

@section('title', 'Популярные рецепты')

@section('content')
    <div class="max-w-7xl mx-auto py-12 px-4">
        <h1 class="text-3xl font-bold mb-8">Популярные рецепты</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($recipes as $recipe)
                <x-recipe-card :recipe="$recipe" />
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500 text-lg">Популярных рецептов пока нет.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection