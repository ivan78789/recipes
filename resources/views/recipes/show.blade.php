@extends('layouts.app')

@section('title', $recipe->title)

@section('content')
    <div class="max-w-4xl mx-auto py-12 px-4">
        <h1 class="text-4xl font-bold">{{ $recipe->title }}</h1>
        <p class="text-gray-600 mt-2">{{ $recipe->description }}</p>

        <article class="mt-6 prose max-w-none">
            {!! nl2br(e($recipe->body)) !!}
        </article>

        <section class="mt-8">
            <h3 class="font-semibold">Отзывы</h3>
            <!-- reviews will be listed here -->
        </section>
    </div>
@endsection
