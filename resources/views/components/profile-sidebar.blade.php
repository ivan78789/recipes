@auth
    @php /** @var \App\Models\User $user */ $user = Auth::user(); @endphp
    <aside class="fixed top-24 right-8 w-72 bg-white rounded-2xl shadow-lg border border-gray-100 z-40 overflow-hidden">
        <!-- Заголовок профиля -->
        <div class="bg-gradient-to-br from-red-500 to-red-600 p-6 text-white">
            <div class="flex flex-col items-center">
                <div class="relative mb-3">
                    <img src="{{ $user->avatar_url ?? asset('img/default-avatar.png') }}" alt="Аватар"
                        class="w-20 h-20 rounded-full border-4 border-white shadow-lg object-cover">
                    <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-green-400 rounded-full border-2 border-white"></div>
                </div>
                <h3 class="font-bold text-lg">{{ $user->name }}</h3>
                <p class="text-red-100 text-sm">{{ $user->email }}</p>
            </div>
        </div>

        <!-- Статистика -->
        <div class="px-4 py-4 bg-gray-50 border-b border-gray-100">
            <div class="grid grid-cols-2 gap-3">
                <div class="text-center">
                    <div class="text-2xl font-bold text-gray-800">{{ $user->recipes()->count() }}</div>
                    <div class="text-xs text-gray-500">Рецептов</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-gray-800">{{ $user->favorites()->count() }}</div>
                    <div class="text-xs text-gray-500">Избранное</div>
                </div>
            </div>
        </div>

        <!-- Навигация -->
        <nav class="p-4">
            <div class="space-y-1">
                <a href="{{ route('recipes.favorites') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-red-50 transition-colors group">
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-red-500" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    <span class="text-gray-700 group-hover:text-red-600 font-medium">Избранное</span>
                </a>

                <a href="{{ route('recipes.my') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-red-50 transition-colors group">
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-red-500" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <span class="text-gray-700 group-hover:text-red-600 font-medium">Мои рецепты</span>
                </a>

                <a href="{{ route('reviews.my') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-red-50 transition-colors group">
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-red-500" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                    </svg>
                    <span class="text-gray-700 group-hover:text-red-600 font-medium">Мои отзывы</span>
                </a>

                <a href="{{ route('profile.edit') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-red-50 transition-colors group">
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-red-500" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="text-gray-700 group-hover:text-red-600 font-medium">Настройки</span>
                </a>

                <div class="border-t border-gray-100 my-2"></div>

                <a href="/" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-50 transition-colors group">
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="text-gray-700 group-hover:text-gray-900 font-medium">На главную</span>
                </a>
            </div>
        </nav>

        <!-- Загрузка аватара -->
        <div class="p-4 border-t border-gray-100">
            <form action="{{ route('profile.avatar') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label class="block text-sm font-semibold text-gray-700 mb-2">Сменить аватар</label>
                <div class="relative">
                    <input type="file" name="avatar" accept="image/*" id="avatar-input" class="hidden"
                        onchange="this.form.querySelector('.file-name').textContent = this.files[0]?.name || 'Файл не выбран'" />
                    <label for="avatar-input"
                        class="flex items-center justify-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg cursor-pointer transition-colors">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="text-sm text-gray-700 font-medium file-name">Выбрать файл</span>
                    </label>
                </div>
                <button type="submit"
                    class="mt-3 w-full bg-red-500 hover:bg-red-600 text-white rounded-lg py-2.5 font-semibold transition-colors shadow-sm">
                    Загрузить
                </button>
            </form>
        </div>
    </aside>
@endauth