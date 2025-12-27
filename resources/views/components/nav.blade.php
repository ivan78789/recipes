<nav class="flex items-center gap-6 relative">
    <!-- Главная -->
    <a href="/"
        class="flex items-center gap-2 text-gray-800 hover:text-red-600 transition-colors relative font-medium px-1 py-2
            after:absolute after:left-0 after:-bottom-1 after:w-0 after:h-0.5 after:bg-red-600 after:transition-all after:duration-300 hover:after:w-full">

        <span>Главная</span>
    </a>

    <!-- Поиск -->
    <div class="flex items-center gap-2">
        @include('components.search-expandable')
    </div>

    <!-- Категории -->
    <a href="{{ route('recipes.index') }}" class="flex items-center gap-2 text-gray-800 hover:text-red-600 transition-colors relative font-medium px-1 py-2
        after:absolute after:left-0 after:-bottom-1 after:w-0 after:h-0.5 after:bg-red-600 after:transition-all after:duration-300 hover:after:w-full">
        <svg class="w-4 h-4 flex-shrink-0" width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
        </svg>
        <span>Категории</span>
    </a>

    <!-- Популярное -->
    <a href="{{ route('recipes.popular') }}" class="flex items-center gap-2 text-gray-800 hover:text-red-600 transition-colors relative font-medium px-1 py-2
        after:absolute after:left-0 after:-bottom-1 after:w-0 after:h-0.5 after:bg-red-600 after:transition-all after:duration-300 hover:after:w-full">
        <svg class="w-4 h-4 flex-shrink-0" width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
            <path
                d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" />
        </svg>
        <span>Популярное</span>
    </a>

    <!-- Избранное -->
    <a href="{{ route('recipes.index') }}" class="flex items-center gap-2 text-gray-800 hover:text-red-600 transition-colors relative font-medium px-1 py-2
        after:absolute after:left-0 after:-bottom-1 after:w-0 after:h-0.5 after:bg-red-600 after:transition-all after:duration-300 hover:after:w-full">
        <svg class="w-4 h-4 flex-shrink-0" width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
        </svg>
        <span>Избранное</span>
    </a>

    <!-- О нас -->
    <a href="{{ url('/about') }}" class="text-gray-800 hover:text-red-600 transition-colors relative font-medium px-1 py-2
        after:absolute after:left-0 after:-bottom-1 after:w-0 after:h-0.5 after:bg-red-600 after:transition-all after:duration-300 hover:after:w-full">
        О нас
    </a>

    <!-- Профиль -->
    @include('components.profile-menu')
</nav>
