@extends('layouts.app')

@section('title', $category->name)

@section('content')
    <div class="max-w-7xl mx-auto py-12 px-4">
        <div class="flex items-center gap-4 mb-8">
            @if($category->image)
                <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" class="w-16 h-16 rounded-xl object-cover">
            @endif
            <div>
                <h1 class="text-3xl font-bold">{{ $category->name }}</h1>
                <p class="text-gray-600">{{ $recipes->total() }} {{ $recipes->total() == 1 ? 'рецепт' : ($recipes->total() < 5 ? 'рецепта' : 'рецептов') }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($recipes as $recipe)
                <x-recipe-card :recipe="$recipe" />
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500 text-lg">В этой категории пока нет рецептов.</p>
                    @auth
                        <a href="{{ route('recipes.create') }}" class="mt-4 inline-block bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 transition">
                            Создать первый рецепт
                        </a>
                    @endauth
                </div>
            @endforelse
        </div>

        @if($recipes->hasPages())
            <div class="mt-8">
                {{ $recipes->links() }}
            </div>
        @endif
    </div>
@endsection

