MyRecipes — Laravel-приложение для обмена рецептами: пользователи публикуют рецепты, оставляют отзывы, ставят в избранное.
Технологии: PHP 8.4,
Laravel 12,
TailwindCSS + Vite,
Swiper (слайдер), MySQL
(Docker/локально).

app — бизнес-логика
Models/ — Recipe, Review, Category, User
Http/Controllers/ — RecipeController, ReviewController, FavoriteController, ProfileController, Auth/_ (регистрация/логин)
resources — UI и ассеты-готовы компоненты
views/ — шаблоны: layouts/app.blade.php, index.blade.php, recipes/_.blade.php, components/_ (шапка, навигация, recipe-card)
css/app.css, js/app.js
public — публичные файлы
build/ — скомпилированные CSS/JS (app-_.css, app-\*.js)
img/image/ — фоновые картинки (bcg.jpg, bcg22.jpg)
routes — маршруты: web.php, auth.php
database — миграции, сиды, фабрики
config — конфигурация (включая session.php, app.php)

/recipes/ - список рецептов
/recipes/popular - популярные
/recipes/favorites - избранное
/recipes/category/{slug} - по категории
/recipes/create - создание (auth) ✅ Теперь работает!
/recipes/my - мои рецепты (auth)
/recipes/{slug}/edit - редактирование (auth)
/recipes/{slug} - просмотр (в конце)

Как запустить локально
Установить зависимости:
composer install
npm install
Собрать фронтенд:
dev: npm run dev (Vite)
prod: npm run build
Настроить .env: APP_URL=http://127.0.0.1:8000, SESSION_DRIVER=file (локально)
Миграции и сиды:
php artisan migrate --seed
Запустить:
php artisan serve --host=127.0.0.1 --port=8000
или через Docker: docker compose up --build
Очистка кэша (если нужно):
php artisan config:clear && php artisan cache:clear && php artisan view:clear && php artisan route:clear
Цель проекта — соцсеть рецептов (CRUD, отзывы, избранное). ✅

Архитектура — Laravel MVC + Tailwind + Vite + MySQL. 🔧
Ключевые сущности: Recipe, Review, Category, User. 💡
Что сделано: аутентификация, CRUD, слайдер, компонентная верстка (x-recipe-card). ✅

то что интереснго:

<!--


 -->

<!--

<header x-data="{ scrolled: false }"
        x-on:scroll.window="scrolled = (window.pageYOffset > 20)"
        :class="scrolled
            ? 'bg-gradient-to-r from-white/95 to-white/90 backdrop-blur-xl shadow-sm py-3 top-2'
            : 'bg-gradient-to-r from-white/60 to-white/50 backdrop-blur-lg py-4 top-4'"
        class="fixed {{ (request()->is('profile*') || request()->is('dashboard')) && Auth::check() ? 'left-[296px]' : 'left-4' }} right-4 flex items-center justify-between px-4 sm:px-8
               transition-all duration-300 ease-in-out z-50 rounded-3xl
               border border-white/40">

    <a href="/" class="text-xl sm:text-2xl font-bold text-gray-800 hover:text-red-600 transition flex-shrink-0">
        {{ config('app.name') }}
    </a>

    {{-- Навигация только если НЕ на странице профиля --}}
    @unless(request()->is('profile*') || request()->is('dashboard'))
        <!-- Десктопная навигация -->

        <nav class="hidden lg:flex items-center gap-6 relative">
            <a href="/" class="flex items-center gap-2 text-gray-800 hover:text-red-600 transition-colors relative font-medium px-1 py-2 after:absolute after:left-0 after:-bottom-1 after:w-0 after:h-0.5 after:bg-red-600 after:transition-all after:duration-300 hover:after:w-full">
                <span>Главная</span>
            </a>

            <div class="flex items-center gap-2">
                @include('components.search-expandable')
            </div>

            <a href="{{ route('recipes.index') }}" class="flex items-center gap-2 text-gray-800 hover:text-red-600 transition-colors relative font-medium px-1 py-2 after:absolute after:left-0 after:-bottom-1 after:w-0 after:h-0.5 after:bg-red-600 after:transition-all after:duration-300 hover:after:w-full">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
                <span>Категории</span>
            </a>

            <a href="{{ route('recipes.popular') }}" class="flex items-center gap-2 text-gray-800 hover:text-red-600 transition-colors relative font-medium px-1 py-2 after:absolute after:left-0 after:-bottom-1 after:w-0 after:h-0.5 after:bg-red-600 after:transition-all after:duration-300 hover:after:w-full">
                <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z"/>
                </svg>
                <span>Популярное</span>
            </a>

            <a href="{{ route('recipes.favorites') }}" class="flex items-center gap-2 text-gray-800 hover:text-red-600 transition-colors relative font-medium px-1 py-2 after:absolute after:left-0 after:-bottom-1 after:w-0 after:h-0.5 after:bg-red-600 after:transition-all after:duration-300 hover:after:w-full">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                </svg>
                <span>Избранное</span>
            </a>

            <a href="{{ url('/about') }}" class="text-gray-800 hover:text-red-600 transition-colors relative font-medium px-1 py-2 after:absolute after:left-0 after:-bottom-1 after:w-0 after:h-0.5 after:bg-red-600 after:transition-all after:duration-300 hover:after:w-full">
                О нас
            </a>

            @include('components.profile-menu')
        </nav>

        <!-- Мобильная навигация -->
        <div class="lg:hidden flex items-center gap-2">
            @include('components.profile-menu')
            @include('components.mobile-menu')
        </div>
    @else
        {{-- На странице профиля только меню профиля --}}
        <div class="hidden lg:block">
            @include('components.profile-menu')
        </div>
        <div class="lg:hidden">
            @include('components.profile-menu')
        </div>
    @endunless

</header> -->
