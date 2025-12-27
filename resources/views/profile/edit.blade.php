<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @auth
                        @php /** @var \App\Models\User $user */ $user = Auth::user(); @endphp
                        <div class="py-8">
                            <div class="max-w-2xl mx-auto bg-white rounded-xl shadow p-6">
                                <div class="mb-4">
                                    <strong>Имя:</strong> {{ $user->name }}
                                </div>
                                <div class="mb-4">
                                    <strong>Email:</strong> {{ $user->email }}
                                </div>
                                <div class="mb-4">
                                    <img src="{{ $user->avatar_url ?? asset('img/default-avatar.png') }}" alt="Аватар" class="w-24 h-24 rounded-full object-cover">
                                </div>

                                <form method="POST" action="{{ route('profile.avatar') }}" enctype="multipart/form-data" class="mt-4">
                                    @csrf
                                    <label class="block mb-2">Загрузить новый аватар</label>
                                    <input type="file" name="avatar" accept="image/*" class="mb-2 block">
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Сохранить</button>
                                </form>

                                <div class="mt-6">
                                    <a href="{{ route('recipes.my') }}" class="text-red-500 hover:underline mr-4">Мои рецепты</a>
                                    <a href="{{ route('recipes.favorites') }}" class="text-red-500 hover:underline">Избранное</a>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="py-8">
                            <div class="max-w-2xl mx-auto bg-white rounded-xl shadow p-6 text-center">
                                <p class="text-gray-700">Вы не вошли в систему или нет доступа к базе данных.</p>
                                <p class="mt-4 text-sm text-gray-500">Если вы ожидаете увидеть профиль — проверьте соединение с базой (DB_HOST в .env) и войдите снова.</p>
                                <div class="mt-4">
                                    <a href="{{ route('login') }}" class="text-red-500 hover:underline mr-4">Войти</a>
                                </div>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
