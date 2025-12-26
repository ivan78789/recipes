<header x-data="{ scrolled: false }" x-on:scroll.window="scrolled = (window.pageYOffset > 50)" :class="scrolled 
            ? 'backdrop-blur-xl bg-book-dark shadow-2xl py-3 top-2' 
            : 'bg-book-dark/80 backdrop-blur-sm py-4 top-4'"
    class="fixed left-4 right-4 flex items-center justify-between px-8 transition-all duration-500 ease-in-out z-50 rounded-3xl border border-book-light/30">

    <h1 class="text-2xl font-bold text-paper">
        {{ config('app.name') }}
    </h1>

    @include('components.nav')
</header>