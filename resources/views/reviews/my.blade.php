@extends('layouts.app')

@section('title', 'Мои отзывы')

@section('content')
    <div class="max-w-6xl mx-auto py-12 px-4">
        <h1 class="text-3xl font-bold mb-8">Мои отзывы</h1>

        <div class="space-y-4">
            @forelse($reviews as $review)
                <div class="bg-white border border-gray-200 rounded-xl p-6">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex-1">
                            <a href="{{ route('recipes.show', $review->recipe) }}" class="text-xl font-bold text-gray-900 hover:text-red-600 transition">
                                {{ $review->recipe->title ?? '—' }}
                            </a>
                            <div class="text-sm text-gray-500 mt-1">{{ $review->created_at->format('d.m.Y H:i') }}</div>
                        </div>
                        <div class="flex items-center gap-1">
                            @for($i = 1; $i <= 5; $i++)
                                <span class="text-lg {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                            @endfor
                        </div>
                    </div>
                    @if($review->comment)
                        <p class="text-gray-700 mb-4">{{ $review->comment }}</p>
                    @endif
                    <div class="flex gap-2">
                        <a href="{{ route('reviews.edit', $review) }}" class="text-sm text-blue-600 hover:text-blue-800">Редактировать</a>
                        <form action="{{ route('reviews.destroy', $review) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm text-red-600 hover:text-red-800" onclick="return confirm('Удалить отзыв?')">Удалить</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-12 text-gray-500">
                    <p class="text-lg">У вас пока нет отзывов.</p>
                </div>
            @endforelse
        </div>

        @if($reviews->hasPages())
            <div class="mt-8">
                {{ $reviews->links() }}
            </div>
        @endif
    </div>
@endsection
