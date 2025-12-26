<nav class="flex items-center gap-6 relative">
    <a href="/" class="text-gray-700 hover:text-red-500 transition-colors relative
              after:absolute after:left-0 after:-bottom-1 after:w-0 after:h-0.5 
              after:bg-red-500 after:transition-all after:duration-300
              hover:after:w-full font-medium">
        Главная
    </a>

    <!-- Вставляем компонент выдвижного поиска -->
    @include('components.search-expandable')

    <a href="/about" class="text-gray-700 hover:text-red-500 transition-colors relative
              after:absolute after:left-0 after:-bottom-1 after:w-0 after:h-0.5 
              after:bg-red-500 after:transition-all after:duration-300
              hover:after:w-full font-medium">
        О нас
    </a>

    <a href="/recipes" class="text-gray-700 hover:text-red-500 transition-colors relative
              after:absolute after:left-0 after:-bottom-1 after:w-0 after:h-0.5 
              after:bg-red-500 after:transition-all after:duration-300
              hover:after:w-full font-medium">
        Все рецепты
    </a>

    <a href="/contact" class="bg-red-500 text-white px-5 py-2 rounded-full 
                  hover:bg-red-600 transition-colors font-medium
                  shadow-md hover:shadow-lg">
        Контакты
    </a>
</nav>