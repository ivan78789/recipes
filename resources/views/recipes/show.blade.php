@extends('layouts.app')

@section('title', $recipe->title)

@section('content')
    <div class="max-w-6xl mx-auto py-12 px-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Основной контент -->
            <div class="lg:col-span-2">
                <!-- Изображение -->
                <div class="mb-8">
                    <img src="{{ $recipe->image ?? asset('img/default-dish.png') }}" 
                         alt="{{ $recipe->title }}" 
                         class="w-full h-96 object-cover rounded-2xl shadow-lg">
                </div>

                <!-- Заголовок и мета-информация -->
                <div class="mb-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <h1 class="text-4xl font-bold text-gray-900 mb-3">{{ $recipe->title }}</h1>
                            @if($recipe->category)
                                <span class="inline-block bg-red-100 text-red-700 px-4 py-1 rounded-full text-sm font-semibold mb-3">
                                    {{ $recipe->category->name }}
                                </span>
                            @endif
                        </div>
                        @auth
                            <form action="{{ route('recipes.favorite.toggle', $recipe) }}" method="POST">
                                @csrf
                                <button type="submit" class="p-3 rounded-full {{ $isFavorite ? 'bg-red-100 text-red-600' : 'bg-gray-100 text-gray-600' }} hover:bg-red-100 hover:text-red-600 transition">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                    </svg>
                                </button>
                            </form>
                        @endauth
                    </div>

                    <p class="text-lg text-gray-600 mb-4">{{ $recipe->description }}</p>

                    <!-- Рейтинг и статистика -->
                    <div class="flex items-center gap-6 mb-6">
                        <div class="flex items-center gap-2">
                            <div class="flex items-center">
                                @php 
                                    $avgRating = $recipe->reviews->avg('rating') ?? 0;
                                    $reviewCount = $recipe->reviews->count();
                                @endphp
                                @for($i = 1; $i <= 5; $i++)
                                    <span class="text-2xl {{ $i <= round($avgRating) ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                                @endfor
                            </div>
                            <span class="text-xl font-bold text-gray-900">{{ number_format($avgRating, 1) }}</span>
                            <span class="text-gray-500">({{ $reviewCount }} {{ $reviewCount == 1 ? 'отзыв' : ($reviewCount < 5 ? 'отзыва' : 'отзывов') }})</span>
                        </div>
                        <div class="text-gray-500">
                            Автор: <span class="font-semibold text-gray-900">{{ $recipe->user->name ?? 'Неизвестен' }}</span>
                        </div>
                        <div class="text-gray-500">
                            {{ $recipe->created_at->format('d.m.Y') }}
                        </div>
                    </div>
                </div>

                <!-- Рецепт -->
                <article class="prose max-w-none mb-8">
                    <div class="bg-gray-50 rounded-xl p-6">
                        <h2 class="text-2xl font-bold mb-4">Рецепт</h2>
                        <div class="text-gray-700 whitespace-pre-line">{{ $recipe->body }}</div>
                    </div>
                </article>

                <!-- Отзывы -->
                <section class="mt-8">
                    <h2 class="text-2xl font-bold mb-6">Отзывы ({{ $reviewCount }})</h2>

                    <!-- Форма добавления отзыва -->
                    @auth
                        <div class="bg-white border border-gray-200 rounded-xl p-6 mb-8">
                            <h3 class="text-lg font-semibold mb-4">Оставить отзыв</h3>
                            <form action="{{ route('reviews.store', $recipe) }}" method="POST" x-data="{ rating: 0 }">
                                @csrf
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Оценка *</label>
                                    <div class="flex gap-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <button type="button" 
                                                    @click="rating = {{ $i }}"
                                                    class="text-3xl transition hover:scale-110"
                                                    :class="rating >= {{ $i }} ? 'text-yellow-400' : 'text-gray-300'">
                                                ★
                                            </button>
                                        @endfor
                                    </div>
                                    <input type="hidden" name="rating" x-model="rating" value="0" required>
                                    @error('rating')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Комментарий</label>
                                    <textarea name="comment" 
                                              rows="4" 
                                              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-red-500 focus:border-red-500"
                                              placeholder="Напишите ваш отзыв..."></textarea>
                                </div>
                                <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 transition">
                                    Отправить отзыв
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="bg-gray-50 rounded-xl p-6 mb-8 text-center">
                            <p class="text-gray-600 mb-2">Войдите, чтобы оставить отзыв</p>
                            <a href="{{ route('login') }}" class="text-red-500 hover:text-red-600 font-medium">Войти</a>
                        </div>
                    @endauth

                    <!-- Список отзывов -->
                    <div class="space-y-4">
                        @forelse($recipe->reviews->sortByDesc('created_at') as $review)
                            <div class="bg-white border border-gray-200 rounded-xl p-6">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center">
                                            <span class="text-gray-600 font-semibold">{{ substr($review->user->name ?? 'U', 0, 1) }}</span>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900">{{ $review->user->name ?? 'Анонимный пользователь' }}</div>
                                            <div class="text-sm text-gray-500">{{ $review->created_at->format('d.m.Y H:i') }}</div>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            <span class="text-lg {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                                        @endfor
                                    </div>
                                </div>
                                @if($review->comment)
                                    <p class="text-gray-700">{{ $review->comment }}</p>
                                @endif
                                @auth
                                    @if($review->user_id === Auth::id())
                                        <div class="mt-4 flex gap-2">
                                            <a href="{{ route('reviews.edit', $review) }}" class="text-sm text-blue-600 hover:text-blue-800">Редактировать</a>
                                            <form action="{{ route('reviews.destroy', $review) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-sm text-red-600 hover:text-red-800" onclick="return confirm('Удалить отзыв?')">Удалить</button>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                            </div>
                        @empty
                            <div class="text-center py-12 text-gray-500">
                                <p class="text-lg">Пока нет отзывов. Будьте первым!</p>
                            </div>
                        @endforelse
                    </div>
                </section>
            </div>

            <!-- Боковая панель -->
            <div class="lg:col-span-1">
                <div class="bg-white border border-gray-200 rounded-xl p-6 sticky top-24">
                    <h3 class="text-lg font-bold mb-4">Информация</h3>
                    <div class="space-y-4">
                        <div>
                            <div class="text-sm text-gray-500 mb-1">Категория</div>
                            <div class="font-semibold">{{ $recipe->category->name ?? 'Не указана' }}</div>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500 mb-1">Автор</div>
                            <div class="font-semibold">{{ $recipe->user->name ?? 'Неизвестен' }}</div>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500 mb-1">Дата публикации</div>
                            <div class="font-semibold">{{ $recipe->created_at->format('d.m.Y') }}</div>
                        </div>
                        @auth
                            @if($recipe->user_id === Auth::id())
                                <div class="pt-4 border-t">
                                    <a href="{{ route('recipes.edit', $recipe) }}" class="block w-full bg-blue-500 text-white text-center py-2 rounded-lg hover:bg-blue-600 transition mb-2">
                                        Редактировать
                                    </a>
                                    <form action="{{ route('recipes.destroy', $recipe) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="block w-full bg-red-500 text-white text-center py-2 rounded-lg hover:bg-red-600 transition" onclick="return confirm('Удалить рецепт?')">
                                            Удалить
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
