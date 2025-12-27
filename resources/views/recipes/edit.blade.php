@extends('layouts.app')

@section('title', 'Редактировать рецепт')

@section('content')
    <div class="max-w-4xl mx-auto py-12 px-4">
        <h1 class="text-3xl font-bold mb-8">Редактировать рецепт</h1>

        <form action="{{ route('recipes.update', $recipe) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow-lg p-8">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Название рецепта *</label>
                <input type="text" 
                       id="title" 
                       name="title" 
                       value="{{ old('title', $recipe->title) }}" 
                       required
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-red-500 focus:border-red-500">
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Категория</label>
                <select id="category_id" 
                        name="category_id" 
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    <option value="">Выберите категорию</option>
                    @foreach($categories ?? [] as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $recipe->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Краткое описание</label>
                <textarea id="description" 
                          name="description" 
                          rows="3"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-red-500 focus:border-red-500">{{ old('description', $recipe->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="body" class="block text-sm font-medium text-gray-700 mb-2">Рецепт *</label>
                <textarea id="body" 
                          name="body" 
                          rows="10"
                          required
                          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-red-500 focus:border-red-500">{{ old('body', $recipe->body) }}</textarea>
                @error('body')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Изображение</label>
                @if($recipe->image)
                    <div class="mb-2">
                        <img src="{{ $recipe->image }}" alt="Текущее изображение" class="w-32 h-32 object-cover rounded-lg">
                    </div>
                @endif
                <input type="file" 
                       id="image" 
                       name="image" 
                       accept="image/*"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-red-500 focus:border-red-500">
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-red-500 text-white px-8 py-3 rounded-lg hover:bg-red-600 transition font-semibold">
                    Сохранить изменения
                </button>
                <a href="{{ route('recipes.show', $recipe) }}" class="bg-gray-200 text-gray-700 px-8 py-3 rounded-lg hover:bg-gray-300 transition font-semibold">
                    Отмена
                </a>
            </div>
        </form>
    </div>
@endsection

