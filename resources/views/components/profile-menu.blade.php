<div x-data="{ open: false }" class="relative">
    <button @click="open = !open" class="text-gray-800 hover:text-red-600 transition-colors p-1 hover:bg-red-50 rounded-full border border-gray-300 hover:border-red-300 flex items-center gap-2">
        @if(Auth::check() && Auth::user()->avatar_url)
            <img src="{{ Auth::user()->avatar_url }}" alt="Аватар" class="w-8 h-8 rounded-full object-cover" />
        @else
            <svg class="w-5 h-5" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
        @endif
    </button>
    <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-200 z-50">
        <ul class="py-2">
            @if(Auth::check())
                <li><a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-red-50">Профиль</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-red-50">Выйти</button>
                    </form>
                </li>
                <li class="border-t my-2"></li>
            @else
                <li><a href="{{ route('register') }}" class="block px-4 py-2 text-gray-700 hover:bg-red-50">Регистрация</a></li>
                <li><a href="{{ route('login') }}" class="block px-4 py-2 text-gray-700 hover:bg-red-50">Вход</a></li>
                <li class="border-t my-2"></li>
            @endif
            <li>
                <button @click="$dispatch('theme-change', 'dark')" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-red-50">Тёмная тема</button>
            </li>
            <li>
                <button @click="$dispatch('theme-change', 'system')" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-red-50">Системная тема</button>
            </li>
            <li>
                <button @click="$dispatch('theme-change', 'light')" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-red-50">Светлая тема</button>
            </li>
        </ul>
    </div>
</div>
