@extends('layouts.app')

@section('title', 'Рецепты')

@section('content')
    <div class="max-w-7xl mx-auto py-12 px-4">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold">Все рецепты</h1>
            @auth
                <a href="{{ route('recipes.create') }}" class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 transition">
                    + Добавить рецепт
                </a>
            @endauth
        </div>

        <!-- Фильтры -->
        @if(isset($categories) && $categories->count() > 0)
            <div class="mb-6 flex flex-wrap gap-2">
                <a href="{{ route('recipes.index') }}" 
                   class="px-4 py-2 rounded-lg {{ !request('category') ? 'bg-red-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Все
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('recipes.index', ['category' => $category->id]) }}" 
                       class="px-4 py-2 rounded-lg {{ request('category') == $category->id ? 'bg-red-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        @endif

        <!-- Список рецептов -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($recipes as $recipe)
                <x-recipe-card :recipe="$recipe" />
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500 text-lg">Рецептов пока нет.</p>
                    @auth
                        <a href="{{ route('recipes.create') }}" class="mt-4 inline-block bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 transition">
                            Создать первый рецепт
                        </a>
                    @endauth
                </div>
            @endforelse
        </div>

        <!-- Пагинация -->
        @if($recipes->hasPages())
            <div class="mt-8">
                {{ $recipes->links() }}
            </div>
        @endif
    </div>
@endsection
