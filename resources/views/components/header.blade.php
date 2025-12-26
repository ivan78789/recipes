<header x-data="{ scrolled: false }" x-on:scroll.window="scrolled = (window.pageYOffset > 20)" :class="scrolled 
            ? 'bg-gradient-to-r from-white/95 to-white/90 backdrop-blur-xl shadow-sm py-3 top-2' 
            : 'bg-gradient-to-r from-white/60 to-white/50 backdrop-blur-lg py-4 top-4'" class="fixed left-4 right-4 flex items-center justify-between px-8 
               transition-all duration-300 ease-in-out z-50 rounded-3xl
               border border-white/40">

    <h1 class="text-2xl font-bold text-gray-800">
        {{ config('app.name') }}
    </h1>

    @include('components.nav')
</header>