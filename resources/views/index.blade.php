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

    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <!-- На завтрак -->
            @if($breakfastRecipes->count() > 0)
                <div class="mb-16">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-4">
                            <img src="{{ asset('img/image/zavtrack.jpg') }}" alt="Завтрак" class="w-16 h-16 rounded-xl object-cover">
                            <h2 class="text-3xl font-bold text-gray-900">На завтрак</h2>
                        </div>
                        @if($breakfastCategory)
                            <a href="{{ route('recipes.category', $breakfastCategory) }}" class="text-red-500 hover:text-red-600 font-medium">
                                Смотреть все →
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
                <div class="mb-16">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-4">
                            <img src="{{ asset('img/image/obed.jpg') }}" alt="Обед" class="w-16 h-16 rounded-xl object-cover">
                            <h2 class="text-3xl font-bold text-gray-900">На обед</h2>
                        </div>
                        @if($lunchCategory)
                            <a href="{{ route('recipes.category', $lunchCategory) }}" class="text-red-500 hover:text-red-600 font-medium">
                                Смотреть все →
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
                <div class="mb-16">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-4">
                            <img src="{{ asset('img/image/yzhin.jpg') }}" alt="Ужин" class="w-16 h-16 rounded-xl object-cover">
                            <h2 class="text-3xl font-bold text-gray-900">На ужин</h2>
                        </div>
                        @if($dinnerCategory)
                            <a href="{{ route('recipes.category', $dinnerCategory) }}" class="text-red-500 hover:text-red-600 font-medium">
                                Смотреть все →
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
                <div class="mb-16">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-3xl font-bold text-gray-900">Лучшее по отзывам</h2>
                        <a href="{{ route('recipes.popular') }}" class="text-red-500 hover:text-red-600 font-medium">
                            Смотреть все →
                        </a>
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
                    <div class="mb-16">
                        <div class="flex items-center justify-between mb-8">
                            <h2 class="text-3xl font-bold text-gray-900">Ваше любимое</h2>
                            <a href="{{ route('recipes.favorites') }}" class="text-red-500 hover:text-red-600 font-medium">
                                Смотреть все →
                            </a>
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
