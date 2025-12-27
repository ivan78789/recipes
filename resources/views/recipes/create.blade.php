@extends('layouts.app')

@section('title', 'MyRecipes')

@section('content')


<h1>Последние рецепты</h1>

<div class="grid grid-cols-3 gap-4">
    @foreach($recipes as $recipe)
        <div class="border p-4 rounded-lg">
            <h2 class="font-bold text-lg">{{ $recipe->title }}</h2>
            <p>{{ $recipe->description }}</p>
            <p class="text-sm text-gray-500">Время: {{ $recipe->time }} мин</p>
        </div>
    @endforeach
</div>


    </section>


@endsection
