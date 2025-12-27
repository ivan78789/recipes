@extends('layouts.app')

@section('title', 'Избранное')

@section('content')
    <div class="max-w-7xl mx-auto py-12 px-4">
        <h1 class="text-3xl font-bold mb-8">Избранное</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($recipes as $recipe)
                <x-recipe-card :recipe="$recipe" />
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500 text-lg mb-4">У вас пока нет избранных рецептов.</p>
                    <a href="{{ route('recipes.index') }}" class="inline-block bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 transition">
                        Найти рецепты
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