<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Мои отзывы</h2>
    </x-slot>
    <div class="py-8">
        <div class="max-w-4xl mx-auto">
            @forelse($reviews as $review)
                <div class="mb-4 p-4 bg-white rounded-xl shadow">
                    <div class="font-bold">Рецепт: {{ $review->recipe->title ?? '—' }}</div>
                    <div>Оценка: {{ $review->rating }}</div>
                    <div>{{ $review->comment }}</div>
                </div>
            @empty
                <div class="text-gray-500">У вас пока нет отзывов.</div>
            @endforelse
            {{ $reviews->links() }}
        </div>
    </div>
</x-app-layout>
