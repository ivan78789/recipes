@extends('layouts.app')

@section('title', 'Мои рецепты')

@section('content')
    <div class="max-w-7xl mx-auto py-12 px-4">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold">Мои рецепты</h1>
            <a href="{{ route('recipes.create') }}" class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 transition">
                + Добавить рецепт
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($recipes as $recipe)
                <x-recipe-card :recipe="$recipe" />
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500 text-lg mb-4">У вас пока нет рецептов.</p>
                    <a href="{{ route('recipes.create') }}" class="inline-block bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 transition">
                        Создать первый рецепт
                    </a>
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
