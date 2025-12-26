@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    <section class="relative h-screen overflow-hidden">
        <div class="swiper-container h-full w-full relative">
            <div class="swiper-wrapper">
                <!-- Слайды -->
                <div class="swiper-slide">
                    <img src="{{ asset('img/image/bcg.jpg') }}" class="w-full h-full object-cover brightness-90">
                    <div class="absolute inset-0 bg-black/10"></div>
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('img/image/bcg22.jpg') }}" class="w-full h-full object-cover brightness-90">
                    <div class="absolute inset-0 bg-black/10"></div>
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('img/image/bcg.jpg') }}" class="w-full h-full object-cover brightness-90">
                    <div class="absolute inset-0 bg-black/10"></div>
                </div>
            </div>



        <!-- Общий текст поверх слайдера -->
        <div class="absolute inset-0 z-40 flex flex-col items-center justify-center text-white px-4 pointer-events-none">
            <h2 class="text-5xl md:text-7xl font-bold mb-6 text-center drop-shadow-2xl">
                Привет! У тебя есть какие-то интеренсые рецепты?
            </h2>
            <p class="text-xl md:text-2xl text-center max-w-2xl drop-shadow-lg">
                Зарегистрируйся и делись своими кулинарными шедеврами с миром!
            </p>
        </div>
    </section>
@endsection 