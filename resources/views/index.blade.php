@extends('layouts.app')

@section('title', 'MyRecipes')

@section('content')
    <section class="relative h-screen overflow-hidden">
        <div class="swiper-container h-full w-full relative">
            <div class="swiper-wrapper">
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

            <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex space-x-2 z-30">
                <span class="swiper-progress-bar block h-1 w-20 bg-white/50 rounded-full"></span>
                <span class="swiper-progress-bar block h-1 w-20 bg-white/50 rounded-full"></span>
                <span class="swiper-progress-bar block h-1 w-20 bg-white/50 rounded-full"></span>
            </div>
        </div>

        <div class="absolute inset-0 z-40 flex flex-col items-center justify-center text-white px-4">
            <h2 class="text-5xl md:text-8xl font-bold mb-8 text-center drop-shadow-2xl opacity-100">
                Делитесь рецептами с миром!
            </h2>
            <p class="text-xl md:text-3xl text-center max-w-3xl mb-12 drop-shadow-lg opacity-100 animation-delay-200">
                Присоединяйтесь к сообществу кулинаров и делитесь своими шедеврами
            </p>
            <a href="{{ route('recipes.create') }}" class="group relative inline-flex items-center gap-3 bg-red-500 text-white
                px-8 py-4 rounded-full hover:bg-red-600 transition-all duration-300
                shadow-md hover:shadow-lg animation-delay-400
                transform hover:-translate-y-0.5">

                <svg class="w-6 h-6 group-hover:scale-110 transition-transform duration-300" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>

                <span class="text-lg font-semibold">Добавить рецепт</span>

                <span class="absolute inset-0 rounded-full bg-red-400 opacity-0
                         group-hover:opacity-30 blur-md transition-opacity duration-300 -z-10">
                </span>
            </a>
            <a href="/recipes" class="mt-8 text-white/80 hover:text-white text-lg
                                                                 underline decoration-dotted underline-offset-4
                                                                 transition-colors animation-delay-600">
                Или просмотрите рецепты других пользователей →
            </a>
        </div>
    </section>

    @php
        use App\Models\Recipe;
        use App\Models\Category;
        
        $breakfastCategory = Category::where('slug', 'zavtrak')->first();
        $lunchCategory = Category::where('slug', 'obed')->first();
        $dinnerCategory = Category::where('slug', 'uzhin')->first();
        
        $breakfastRecipes = $breakfastCategory 
            ? Recipe::where('category_id', $breakfastCategory->id)->with(['category', 'reviews', 'user'])->latest()->take(4)->get()
            : collect();
        
        $lunchRecipes = $lunchCategory 
            ? Recipe::where('category_id', $lunchCategory->id)->with(['category', 'reviews', 'user'])->latest()->take(4)->get()
            : collect();
        
        $dinnerRecipes = $dinnerCategory 
            ? Recipe::where('category_id', $dinnerCategory->id)->with(['category', 'reviews', 'user'])->latest()->take(4)->get()
            : collect();
        
        $topRatedRecipes = Recipe::with(['category', 'reviews', 'user'])
            ->withCount('reviews')
            ->having('reviews_count', '>', 0)
            ->get()
            ->sortByDesc(function($recipe) {
                return $recipe->reviews->avg('rating');
            })
            ->take(4);
        
        $favoriteRecipes = Auth::check() 
            ? Auth::user()->favorites()->with(['category', 'reviews', 'user'])->latest()->take(4)->get()
            : collect();
    @endphp

    <section class="py-16 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-4">
            <!-- На завтрак -->
            @if($breakfastRecipes->count() > 0)
                <div class="mb-20">
                    <div class="flex items-center justify-between mb-10">
                        <div class="flex items-center gap-4">
                            <div class="relative">
                                <img src="{{ asset('img/image/zavtrack.jpg') }}" alt="Завтрак" class="w-20 h-20 rounded-2xl object-cover shadow-lg">
                                <div class="absolute inset-0 bg-gradient-to-br from-yellow-400/20 to-orange-500/20 rounded-2xl"></div>
                            </div>
                            <div>
                                <h2 class="text-4xl font-bold text-gray-900 mb-1">На завтрак</h2>
                                <p class="text-gray-600">Начните день с вкусного завтрака</p>
                            </div>
                        </div>
                        @if($breakfastCategory)
                            <a href="{{ route('recipes.category', $breakfastCategory) }}" class="group flex items-center gap-2 text-red-500 hover:text-red-600 font-semibold transition">
                                <span>Смотреть все</span>
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </a>
                        @endif
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($breakfastRecipes as $recipe)
                            <x-recipe-card :recipe="$recipe" />
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- На обед -->
            @if($lunchRecipes->count() > 0)
                <div class="mb-20">
                    <div class="flex items-center justify-between mb-10">
                        <div class="flex items-center gap-4">
                            <div class="relative">
                                <img src="{{ asset('img/image/obed.jpg') }}" alt="Обед" class="w-20 h-20 rounded-2xl object-cover shadow-lg">
                                <div class="absolute inset-0 bg-gradient-to-br from-green-400/20 to-emerald-500/20 rounded-2xl"></div>
                            </div>
                            <div>
                                <h2 class="text-4xl font-bold text-gray-900 mb-1">На обед</h2>
                                <p class="text-gray-600">Сытные и вкусные блюда для обеда</p>
                            </div>
                        </div>
                        @if($lunchCategory)
                            <a href="{{ route('recipes.category', $lunchCategory) }}" class="group flex items-center gap-2 text-red-500 hover:text-red-600 font-semibold transition">
                                <span>Смотреть все</span>
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </a>
                        @endif
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($lunchRecipes as $recipe)
                            <x-recipe-card :recipe="$recipe" />
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- На ужин -->
            @if($dinnerRecipes->count() > 0)
                <div class="mb-20">
                    <div class="flex items-center justify-between mb-10">
                        <div class="flex items-center gap-4">
                            <div class="relative">
                                <img src="{{ asset('img/image/yzhin.jpg') }}" alt="Ужин" class="w-20 h-20 rounded-2xl object-cover shadow-lg">
                                <div class="absolute inset-0 bg-gradient-to-br from-purple-400/20 to-indigo-500/20 rounded-2xl"></div>
                            </div>
                            <div>
                                <h2 class="text-4xl font-bold text-gray-900 mb-1">На ужин</h2>
                                <p class="text-gray-600">Завершите день изысканным ужином</p>
                            </div>
                        </div>
                        @if($dinnerCategory)
                            <a href="{{ route('recipes.category', $dinnerCategory) }}" class="group flex items-center gap-2 text-red-500 hover:text-red-600 font-semibold transition">
                                <span>Смотреть все</span>
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </a>
                        @endif
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($dinnerRecipes as $recipe)
                            <x-recipe-card :recipe="$recipe" />
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Лучшее по отзывам -->
            @if($topRatedRecipes->count() > 0)
                <div class="mb-20">
                    <div class="bg-gradient-to-r from-yellow-50 to-orange-50 rounded-3xl p-8 mb-10">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-2xl flex items-center justify-center shadow-lg">
                                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-4xl font-bold text-gray-900 mb-1">Лучшее по отзывам</h2>
                                    <p class="text-gray-600">Топ рецептов, которые понравились пользователям</p>
                                </div>
                            </div>
                            <a href="{{ route('recipes.popular') }}" class="group flex items-center gap-2 text-red-500 hover:text-red-600 font-semibold transition">
                                <span>Смотреть все</span>
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($topRatedRecipes as $recipe)
                            <x-recipe-card :recipe="$recipe" />
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Ваше любимое -->
            @auth
                @if($favoriteRecipes->count() > 0)
                    <div class="mb-20">
                        <div class="bg-gradient-to-r from-red-50 to-pink-50 rounded-3xl p-8 mb-10">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <div class="w-16 h-16 bg-gradient-to-br from-red-400 to-pink-500 rounded-2xl flex items-center justify-center shadow-lg">
                                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h2 class="text-4xl font-bold text-gray-900 mb-1">Ваше любимое</h2>
                                        <p class="text-gray-600">Рецепты, которые вы добавили в избранное</p>
                                    </div>
                                </div>
                                <a href="{{ route('recipes.favorites') }}" class="group flex items-center gap-2 text-red-500 hover:text-red-600 font-semibold transition">
                                    <span>Смотреть все</span>
                                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            @foreach($favoriteRecipes as $recipe)
                                <x-recipe-card :recipe="$recipe" />
                            @endforeach
                        </div>
                    </div>
                @endif
            @endauth
        </div>
    </section>


@endsection
