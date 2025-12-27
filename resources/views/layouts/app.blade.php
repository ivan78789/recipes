<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('MyRecipes', config('app.name'))</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="">
    @include('components.header')
    
    {{-- Сайдбар только на странице профиля --}}
    @if(request()->is('profile*') || request()->is('dashboard'))
        @include('components.main-sidebar')
    @endif

    {{-- spacer: отступ под фиксированную шапку на всех страницах, кроме главной (где хедер накладывается на геро) --}}
    @unless(request()->is('/'))
        <div class="h-28 md:h-32"></div>
    @endunless

    <main class="{{ (request()->is('profile*') || request()->is('dashboard')) && Auth::check() ? 'ml-[280px]' : '' }}">
        @yield('content')
    </main>

    @include('components.footer')
</body>


</html>
