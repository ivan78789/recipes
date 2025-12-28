<header x-data="{ scrolled: false }"
        x-on:scroll.window="scrolled = (window.pageYOffset > 20)"
        :class="scrolled
            ? 'bg-gradient-to-r from-white/95 to-white/90 backdrop-blur-xl shadow-sm py-3 top-2'
            : 'bg-gradient-to-r from-white/60 to-white/50 backdrop-blur-lg py-4 top-4'"
        class="fixed {{ (request()->is('profile*') || request()->is('dashboard')) && Auth::check() ? 'left-[296px]' : 'left-4' }} right-4 flex items-center justify-between px-8
               transition-all duration-300 ease-in-out z-50 rounded-3xl
               border border-white/40">

    <a href="/" class="text-2xl font-bold text-gray-800 hover:text-red-600 transition">
        {{ config('app.name') }}
    </a>

    {{-- Навигация в header только если НЕ на странице профиля --}}
    @unless(request()->is('profile*') || request()->is('dashboard'))
        <!-- Десктопная навигация -->
        <nav class="hidden lg:flex items-center gap-6">
            <a href="/" class="text-gray-800 hover:text-red-600 transition-colors relative font-medium px-1 py-2 after:absolute after:left-0 after:-bottom-1 after:w-0 after:h-0.5 after:bg-red-600 after:transition-all after:duration-300 hover:after:w-full">
                Главная
            </a>

            <a href="{{ route('recipes.index') }}" class="text-gray-800 hover:text-red-600 transition-colors relative font-medium px-1 py-2 after:absolute after:left-0 after:-bottom-1 after:w-0 after:h-0.5 after:bg-red-600 after:transition-all after:duration-300 hover:after:w-full">
                Категории
            </a>

            <a href="{{ route('recipes.popular') }}" class="text-gray-800 hover:text-red-600 transition-colors relative font-medium px-1 py-2 after:absolute after:left-0 after:-bottom-1 after:w-0 after:h-0.5 after:bg-red-600 after:transition-all after:duration-300 hover:after:w-full">
                Популярное
            </a>

            <a href="{{ route('recipes.favorites') }}" class="text-gray-800 hover:text-red-600 transition-colors relative font-medium px-1 py-2 after:absolute after:left-0 after:-bottom-1 after:w-0 after:h-0.5 after:bg-red-600 after:transition-all after:duration-300 hover:after:w-full">
                Избранное
            </a>

            <a href="{{ url('/about') }}" class="text-gray-800 hover:text-red-600 transition-colors relative font-medium px-1 py-2 after:absolute after:left-0 after:-bottom-1 after:w-0 after:h-0.5 after:bg-red-600 after:transition-all after:duration-300 hover:after:w-full">
                О нас
            </a>

            <!-- Поиск -->
            <div class="flex items-center gap-2">
                @include('components.search-expandable')
            </div>

            <!-- Профиль меню -->
            @include('components.profile-menu')
        </nav>

        <!-- Мобильная навигация -->
        <div class="lg:hidden flex items-center gap-4">
            @include('components.profile-menu')
            @include('components.mobile-menu')
        </div>

    @else
        {{-- На странице профиля только меню профиля --}}
        <div class="flex items-center gap-4">
            @include('components.profile-menu')
        </div>
    @endunless
</header>
