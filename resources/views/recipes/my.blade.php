<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Мои рецепты</h2>
    </x-slot>
    <div class="py-8">
        <div class="max-w-4xl mx-auto">
            @forelse($recipes as $recipe)
                <div class="mb-4 p-4 bg-white rounded-xl shadow">
                    <h3 class="font-bold text-lg">{{ $recipe->title }}</h3>
                    <p>{{ $recipe->description }}</p>
                    <a href="{{ route('recipes.show', $recipe) }}" class="text-red-500 hover:underline">Подробнее</a>
                </div>
            @empty
                <div class="text-gray-500">У вас пока нет рецептов.</div>
            @endforelse
            {{ $recipes->links() }}
        </div>
    </div>
</x-app-layout>
