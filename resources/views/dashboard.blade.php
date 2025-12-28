@extends('layouts.app')

@section('title', 'Профиль')

@section('content')
    <div class="flex flex-row gap-8">
        @include('components.main-sidebar')

        <div class="flex-1">
            @auth
                <div class="bg-white rounded-xl shadow p-8">
                    @php /** @var \App\Models\User $user */ $user = Auth::user(); @endphp
                    <h2 class="text-2xl font-bold mb-4">Профиль пользователя</h2>
                    <div class="mb-4"><strong>Имя:</strong> {{ $user->name }}</div>
                    <div class="mb-4"><strong>Email:</strong> {{ $user->email }}</div>

                    <div class="mb-4">
                        <strong>Аватар:</strong>
                        <div class="mt-2">
                            <img src="{{ $user->avatar_url ?? asset('img/default-avatar.png') }}"
                                 alt="Аватар"
                                 class="w-24 h-24 rounded-full object-cover">
                        </div>
                    </div>

                    <!-- Форма загрузки аватара -->
                    <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                        <h3 class="font-semibold mb-3">Изменить аватар</h3>

                        @if(session('status') === 'avatar-updated')
                            <div class="mb-3 p-3 bg-green-100 text-green-700 rounded">
                                ✓ Аватар успешно обновлен!
                            </div>
                        @endif

                        @error('avatar')
                            <div class="mb-3 p-3 bg-red-100 text-red-700 rounded">
                                {{ $message }}
                            </div>
                        @enderror

                        <form method="POST" action="{{ route('profile.avatar') }}" enctype="multipart/form-data">
                            @csrf
                            <label class="block mb-2 font-semibold text-sm text-gray-700">
                                Выберите новое изображение
                            </label>
                            <input type="file"
                                   name="avatar"
                                   accept="image/*"
                                   class="mb-3 block w-full text-sm text-gray-500
                                          file:mr-4 file:py-2 file:px-4
                                          file:rounded file:border-0
                                          file:text-sm file:font-semibold
                                          file:bg-red-50 file:text-red-700
                                          hover:file:bg-red-100
                                          cursor-pointer">
                            <button type="submit"
                                    class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">
                                Загрузить аватар
                            </button>
                        </form>
                    </div>

                    <div class="mb-4">
                        <h3 class="text-lg font-semibold mb-2">Мои рецепты</h3>
                        @if(isset($recipes) && count($recipes))
                            <ul class="list-disc pl-6">
                                @foreach($recipes as $recipe)
                                    <li><a href="{{ route('recipes.show', $recipe) }}"
                                            class="text-red-500 hover:underline">{{ $recipe->title }}</a></li>
                                @endforeach
                            </ul>
                        @else
                            <div class="text-gray-500">Рецептов пока нет.</div>
                        @endif
                    </div>

                    <div class="mb-4">
                        <h3 class="text-lg font-semibold mb-2">Избранное</h3>
                        @if(isset($favorites) && count($favorites))
                            <ul class="list-disc pl-6">
                                @foreach($favorites as $fav)
                                    <li><a href="{{ route('recipes.show', $fav) }}"
                                            class="text-red-500 hover:underline">{{ $fav->title }}</a></li>
                                @endforeach
                            </ul>
                        @else
                            <div class="text-gray-500">Нет избранных рецептов.</div>
                        @endif
                    </div>

                    <!-- Profile edit forms -->
                    <div class="mt-6 space-y-6">
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <h3 class="font-semibold mb-3">Редактирование профиля</h3>
                            @include('profile.partials.update-profile-information-form')
                        </div>

                        <div class="p-4 bg-gray-50 rounded-lg">
                            <h3 class="font-semibold mb-3">Изменить пароль</h3>
                            @include('profile.partials.update-password-form')
                        </div>

                        <div class="p-4 bg-gray-50 rounded-lg">
                            <h3 class="font-semibold mb-3">Удалить аккаунт</h3>
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white rounded-xl shadow p-8 text-center">
                    <p class="text-gray-700">Вы не вошли в систему. Пожалуйста, <a href="{{ route('login') }}"
                            class="text-red-500">войдите</a>.</p>
                </div>
            @endauth
        </div>
    </div>
@endsection
