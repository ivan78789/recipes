@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    <section class="relative h-screen overflow-hidden">
        <div class="swiper-container h-full w-full relative">
            <div class="swiper-wrapper">
                <!-- Слайды (только картинки, текст общий ниже) -->
                <div class="swiper-slide">
                    <img src="{{ asset('img/image/aniimage.jpg') }}" class="w-full h-full object-cover brightness-90">
                    <div class="absolute inset-0 bg-black/10"></div>
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('img/image/book.jpg') }}" class="w-full h-full object-cover brightness-90">
                    <div class="absolute inset-0 bg-black/10"></div>
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('img/image/image.png') }}" class="w-full h-full object-cover brightness-90">
                    <div class="absolute inset-0 bg-black/10"></div>
                </div>
            </div>

            <!-- Прогресс бар -->
            <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex space-x-2 z-30">
                <span class="swiper-progress-bar block h-1 w-20 bg-white/50 rounded-full"></span>
                <span class="swiper-progress-bar block h-1 w-20 bg-white/50 rounded-full"></span>
                <span class="swiper-progress-bar block h-1 w-20 bg-white/50 rounded-full"></span>
            </div>
        </div>

        <!-- Общий текст поверх слайдера -->
        <div class="absolute inset-0 z-40 flex flex-col items-center justify-center text-white px-4">
            <h2 class="text-5xl md:text-7xl font-bold mb-6 text-center drop-shadow-2xl">
                Добро пожаловать
            </h2>
            <p class="text-xl md:text-2xl text-center max-w-2xl drop-shadow-lg">
                Современные технологии для вашего бизнеса
            </p>
        </div>
    </section>
@endsection