@extends('layouts.app')

@section('title', $recipe->title)

@section('content')
    <div class="max-w-4xl mx-auto py-12 px-4">
        <img src="{{ $recipe->image ?? asset('img/default-dish.png') }}" alt="{{ $recipe->title }}" class="w-64 h-64 object-cover rounded-xl mb-6">
        <h1 class="text-4xl font-bold">{{ $recipe->title }}</h1>
        <p class="text-gray-600 mt-2">{{ $recipe->description }}</p>
        <div class="flex items-center gap-2 mt-2">
            <span class="text-yellow-500 font-bold">
                @php $avg = $recipe->reviews->avg('rating'); @endphp
                {{ $avg ? number_format($avg, 1) : '—' }} ★
            </span>
            <span class="text-xs text-gray-400">({{ $recipe->reviews->count() }} отзывов)</span>
        </div>
        <article class="mt-6 prose max-w-none">
            {!! nl2br(e($recipe->body)) !!}
        </article>
        <section class="mt-8">
            <h3 class="font-semibold mb-4">Отзывы</h3>
            @forelse($recipe->reviews as $review)
                <div class="mb-4 p-4 bg-gray-50 rounded-xl">
                    <div class="font-bold text-yellow-500">Оценка: {{ $review->rating }} ★</div>
                    <div class="text-gray-700">{{ $review->comment }}</div>
                </div>
            @empty
                <div class="text-gray-400">Пока нет отзывов.</div>
            @endforelse
        </section>
    </div>
@endsection
