@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    <section class="relative h-screen overflow-hidden">
        <div class="swiper-container h-full w-full relative">
            <div class="swiper-wrapper">
                <!-- Слайды -->
                <div class="swiper-slide">
                    <img src="{{ asset('img/image/aniimage.jpg') }}" class="w-full h-full object-cover brightness-90">
                    <div class="absolute inset-0 bg-gradient-to-b from-black/30 via-transparent to-black/50"></div>
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('img/image/book.jpg') }}" class="w-full h-full object-cover brightness-90">
                    <div class="absolute inset-0 bg-gradient-to-b from-black/30 via-transparent to-black/50"></div>
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('img/image/image.png') }}" class="w-full h-full object-cover brightness-90">
                    <div class="absolute inset-0 bg-gradient-to-b from-black/30 via-transparent to-black/50"></div>
                </div>
            </div>

            <!-- Улучшенный прогресс бар -->
            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 flex space-x-3 z-30 items-center">
                <span class="swiper-progress-bar" data-index="0"></span>
                <span class="swiper-progress-bar" data-index="1"></span>
                <span class="swiper-progress-bar" data-index="2"></span>
            </div>
        </div>

        <!-- Общий текст -->
        <div class="absolute inset-0 z-40 flex flex-col items-center justify-center text-white px-4">
            <h2 class="text-5xl md:text-8xl font-bold mb-6 text-center drop-shadow-2xl animate-fade-in-up">
                Добро пожаловать
            </h2>
            <p class="text-xl md:text-3xl text-center max-w-3xl drop-shadow-lg animate-fade-in-up animation-delay-300">
                Современные технологии для вашего бизнеса
            </p>
        </div>
    </section>

    <style>
        .animate-fade-in-up {
            animation: fadeInUp 1s ease-out forwards;
            opacity: 0;
        }
        
        .animation-delay-300 {
            animation-delay: 0.3s;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Плавная анимация для перехода слайдов */
        .swiper-slide {
            animation: slideFadeIn 2s ease-out;
        }
        
        @keyframes slideFadeIn {
            from {
                opacity: 0.8;
            }
            to {
                opacity: 1;
            }
        }
    </style>
@endsection