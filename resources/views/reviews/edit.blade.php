@extends('layouts.app')

@section('title', 'Редактировать отзыв')

@section('content')
    <div class="max-w-2xl mx-auto py-12 px-4">
        <h1 class="text-3xl font-bold mb-8">Редактировать отзыв</h1>

        <div class="bg-white rounded-xl shadow-lg p-8 mb-6">
            <h2 class="text-xl font-semibold mb-2">{{ $review->recipe->title }}</h2>
            <p class="text-gray-600">{{ $review->recipe->description }}</p>
        </div>

        <form action="{{ route('reviews.update', $review) }}" method="POST" class="bg-white rounded-xl shadow-lg p-8">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Оценка *</label>
                <div class="flex gap-2" x-data="{ rating: {{ old('rating', $review->rating) }} }">
                    @for($i = 1; $i <= 5; $i++)
                        <button type="button" 
                                @click="rating = {{ $i }}"
                                class="text-4xl transition"
                                :class="rating >= {{ $i }} ? 'text-yellow-400' : 'text-gray-300'">
                            ★
                        </button>
                    @endfor
                    <input type="hidden" name="rating" x-model="rating" value="{{ old('rating', $review->rating) }}" required>
                </div>
                @error('rating')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">Комментарий</label>
                <textarea id="comment" 
                          name="comment" 
                          rows="6"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-red-500 focus:border-red-500">{{ old('comment', $review->comment) }}</textarea>
                @error('comment')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-red-500 text-white px-8 py-3 rounded-lg hover:bg-red-600 transition font-semibold">
                    Сохранить изменения
                </button>
                <a href="{{ route('recipes.show', $review->recipe) }}" class="bg-gray-200 text-gray-700 px-8 py-3 rounded-lg hover:bg-gray-300 transition font-semibold">
                    Отмена
                </a>
            </div>
        </form>
    </div>
@endsection

