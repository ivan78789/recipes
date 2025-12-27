@extends('layouts.app')


@section('title', 'Профиль')

@section('content')
    <div class="flex flex-row gap-8">
        @include('components.profile-sidebar')
        <div id="profile-main" class="flex-1">
            @auth
                <div class="bg-white rounded-xl shadow p-8">
                    @php /** @var \App\Models\User $user */ $user = Auth::user(); @endphp
                    <h2 class="text-2xl font-bold mb-4">Профиль пользователя</h2>
                    <div class="mb-4"><strong>Имя:</strong> {{ $user->name }}</div>
                    <div class="mb-4"><strong>Email:</strong> {{ $user->email }}</div>
                    <div class="mb-4">
                        <img src="{{ $user->avatar_url ?? asset('img/default-avatar.png') }}" alt="Аватар"
                            class="w-24 h-24 rounded-full object-cover">
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

                    <!-- Profile edit forms (moved from profile.edit) -->
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