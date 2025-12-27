@extends('layouts.app')

@section('title', 'Мои рецепты')

@section('content')
    <div class="max-w-7xl mx-auto py-12 px-4">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold mb-2">Мои рецепты</h1>
                <p class="text-gray-600">Управляйте своими рецептами</p>
            </div>
            <a href="{{ route('recipes.create') }}" class="bg-red-500 text-white px-6 py-3 rounded-lg hover:bg-red-600 transition font-semibold flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Добавить рецепт
            </a>
        </div>

        @if($recipes->count() > 0)
            <div class="mb-4 text-gray-600">
                Всего рецептов: <span class="font-semibold">{{ $recipes->total() }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($recipes as $recipe)
                <div class="relative group">
                    <x-recipe-card :recipe="$recipe" />
                    <div class="absolute top-2 right-2 flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                        <a href="{{ route('recipes.edit', $recipe) }}" 
                           class="bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600 transition"
                           title="Редактировать">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </a>
                        <form action="{{ route('recipes.destroy', $recipe) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition"
                                    title="Удалить"
                                    onclick="return confirm('Вы уверены, что хотите удалить этот рецепт?')">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                        <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">У вас пока нет рецептов</h3>
                        <p class="text-gray-600 mb-6">Создайте свой первый рецепт и поделитесь им с миром!</p>
                        <a href="{{ route('recipes.create') }}" class="inline-block bg-red-500 text-white px-8 py-3 rounded-lg hover:bg-red-600 transition font-semibold">
                            Создать первый рецепт
                        </a>
                    </div>
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
