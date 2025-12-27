@auth
    @php /** @var \App\Models\User $user */ $user = Auth::user(); @endphp
    <style>
        .profile-sidebar {
            position: fixed;
            top: 120px;
            right: 32px;
            width: 288px;
            background: var(--color-bg-card, #ffffff);
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(66, 50, 42, 0.15);
            border: 1px solid var(--color-border, rgba(0, 0, 0, 0.06));
            z-index: 40;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .profile-sidebar:hover {
            box-shadow: 0 20px 40px rgba(66, 50, 42, 0.2);
        }

        .profile-header {
            background: linear-gradient(135deg, var(--color-tomato, #f56565), var(--color-brick, #b22222));
            padding: 24px;
            color: white;
            text-align: center;
        }

        .profile-avatar {
            position: relative;
            display: inline-block;
            margin-bottom: 12px;
        }

        .profile-avatar img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 4px solid white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            object-fit: cover;
        }

        .profile-status {
            position: absolute;
            bottom: -4px;
            right: -4px;
            width: 24px;
            height: 24px;
            background: var(--color-mint, #7dd3a6);
            border-radius: 50%;
            border: 3px solid white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .profile-name {
            font-weight: 700;
            font-size: 18px;
            margin-bottom: 4px;
            letter-spacing: -0.5px;
        }

        .profile-email {
            color: rgba(255, 255, 255, 0.85);
            font-size: 13px;
        }

        .profile-stats {
            padding: 20px 16px;
            background: var(--color-bg-light, #f8f5f0);
            border-bottom: 1px solid var(--color-border, rgba(0, 0, 0, 0.06));
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .stat-item {
            text-align: center;
            padding: 8px;
            background: white;
            border-radius: 12px;
            transition: transform 0.2s;
        }

        .stat-item:hover {
            transform: translateY(-2px);
        }

        .stat-number {
            font-size: 28px;
            font-weight: 700;
            color: var(--color-tomato, #f56565);
            line-height: 1;
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 12px;
            color: var(--color-choco, #2d3748);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .profile-nav {
            padding: 16px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 12px;
            text-decoration: none;
            color: var(--color-choco, #2d3748);
            font-weight: 500;
            transition: all 0.25s ease;
            margin-bottom: 4px;
            position: relative;
            overflow: hidden;
        }

        .nav-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 0;
            height: 100%;
            background: linear-gradient(90deg, var(--color-peach, #ffd1c1), transparent);
            transition: width 0.3s ease;
            z-index: -1;
        }

        .nav-item:hover::before {
            width: 100%;
        }

        .nav-item:hover {
            color: var(--color-brick, #b22222);
            transform: translateX(4px);
        }

        .nav-item svg {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
            transition: transform 0.25s ease;
        }

        .nav-item:hover svg {
            transform: scale(1.1);
            color: var(--color-tomato, #f56565);
        }

        .nav-divider {
            border-top: 1px solid var(--color-border, rgba(0, 0, 0, 0.06));
            margin: 12px 0;
        }

        .upload-section {
            padding: 16px;
            border-top: 1px solid var(--color-border, rgba(0, 0, 0, 0.06));
            background: var(--color-bg-light, #f8f5f0);
        }

        .upload-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--color-choco, #2d3748);
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .file-input-wrapper {
            position: relative;
        }

        .file-input-wrapper input[type="file"] {
            display: none;
        }

        .file-input-label {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 16px;
            background: white;
            border: 2px dashed var(--color-border, rgba(0, 0, 0, 0.1));
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .file-input-label:hover {
            border-color: var(--color-tomato, #f56565);
            background: var(--color-peach, #ffd1c1);
        }

        .file-input-label svg {
            width: 20px;
            height: 20px;
            color: var(--color-choco, #2d3748);
        }

        .file-name {
            font-size: 13px;
            color: var(--color-choco, #2d3748);
            font-weight: 500;
        }

        .upload-button {
            width: 100%;
            background: linear-gradient(135deg, var(--color-tomato, #f56565), var(--color-caramel, #f6ad55));
            color: white;
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 12px;
            transition: all 0.25s ease;
            box-shadow: 0 4px 10px rgba(245, 101, 101, 0.3);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 13px;
        }

        .upload-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(245, 101, 101, 0.4);
        }

        .upload-button:active {
            transform: translateY(0);
        }
    </style>

    <aside class="profile-sidebar">
        <!-- Заголовок профиля -->
        <div class="profile-header">
            <div class="profile-avatar">
                <img src="{{ $user->avatar_url ?? asset('img/default-avatar.png') }}" alt="Аватар">
                <div class="profile-status"></div>
            </div>
            <h3 class="profile-name">{{ $user->name }}</h3>
            <p class="profile-email">{{ $user->email }}</p>
        </div>

        <!-- Статистика -->
        <div class="profile-stats">
            <div class="stat-item">
                <div class="stat-number">
                    {{ method_exists($user, 'recipes') ? $user->recipes()->count() : 0 }}
                </div>
                <div class="stat-label">Рецептов</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">
                    {{ method_exists($user, 'favorites') ? $user->favorites()->count() : 0 }}
                </div>
                <div class="stat-label">Избранное</div>
            </div>
        </div>

        <!-- Навигация -->
        <nav class="profile-nav">
            <a href="{{ route('recipes.favorites') }}" class="nav-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                <span>Избранное</span>
            </a>

            <a href="{{ route('recipes.my') }}" class="nav-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                <span>Мои рецепты</span>
            </a>

            <a href="{{ route('reviews.my') }}" class="nav-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                </svg>
                <span>Мои отзывы</span>
            </a>

            <a href="{{ route('profile.edit') }}" class="nav-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span>Настройки</span>
            </a>

            <div class="nav-divider"></div>

            <a href="/" class="nav-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span>На главную</span>
            </a>
        </nav>

        <!-- Загрузка аватара -->
        <div class="upload-section">
            <form action="{{ route('profile.avatar') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label class="upload-label">Сменить аватар</label>
                <div class="file-input-wrapper">
                    <input type="file" name="avatar" accept="image/*" id="avatar-input" onchange="this.form.querySelector('.file-name').textContent = this.files[0]?.name || 'Выбрать файл'" />
                    <label for="avatar-input" class="file-input-label">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="file-name">Выбрать файл</span>
                    </label>
                </div>
                <button type="submit" class="upload-button">Загрузить</button>
            </form>
        </div>
    </aside>
@endauth
