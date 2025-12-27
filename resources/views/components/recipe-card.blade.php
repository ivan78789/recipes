@props(['recipe'])

@php
    use Illuminate\Support\Str;
    $avgRating = $recipe->reviews->avg('rating') ?? 0;
    $reviewCount = $recipe->reviews->count();
    $isFavorite = Auth::check() && Auth::user()->favorites()->where('recipe_id', $recipe->id)->exists();
@endphp

<div class="recipe-card" x-data="{ showDetails: false }" @mouseenter="showDetails = true" @mouseleave="showDetails = false">
    <a href="{{ route('recipes.show', $recipe) }}" class="recipe-card-link">
        <div class="recipe-image-wrapper">
            <img src="{{ $recipe->image ?? asset('img/default-dish.png') }}" 
                 alt="{{ $recipe->title }}" 
                 class="recipe-image">
            @if($recipe->category)
                <div class="recipe-category-badge">
                    {{ $recipe->category->name }}
                </div>
            @endif
            @auth
                <form action="{{ route('recipes.favorite.toggle', $recipe) }}" method="POST" class="favorite-form" @click.stop>
                    @csrf
                    <button type="submit" class="favorite-btn {{ $isFavorite ? 'active' : '' }}">
                        <svg fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>
                    </button>
                </form>
            @endauth
        </div>
        
        <div class="recipe-content">
            <h3 class="recipe-title">{{ $recipe->title }}</h3>
            <p class="recipe-description">{{ Str::limit($recipe->description ?? '', 100) }}</p>
            
            <div class="recipe-meta">
                <div class="recipe-rating">
                    <span class="rating-stars">
                        @for($i = 1; $i <= 5; $i++)
                            <span class="star {{ $i <= round($avgRating) ? 'filled' : '' }}">★</span>
                        @endfor
                    </span>
                    <span class="rating-value">{{ number_format($avgRating, 1) }}</span>
                    <span class="rating-count">({{ $reviewCount }})</span>
                </div>
            </div>
        </div>

        <div x-show="showDetails" 
             x-transition
             class="recipe-hover-details">
            <div class="hover-content">
                <p class="hover-description">{{ Str::limit($recipe->description ?? '', 150) }}</p>
                <div class="hover-meta">
                    <span class="hover-author">Автор: {{ $recipe->user->name ?? 'Неизвестен' }}</span>
                    <span class="hover-date">{{ $recipe->created_at->format('d.m.Y') }}</span>
                </div>
                <div class="hover-button">Подробнее →</div>
            </div>
        </div>
    </a>
</div>

<style>
    .recipe-card {
        position: relative;
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .recipe-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    }

    .recipe-card-link {
        display: flex;
        flex-direction: column;
        height: 100%;
        text-decoration: none;
        color: inherit;
    }

    .recipe-image-wrapper {
        position: relative;
        width: 100%;
        height: 200px;
        overflow: hidden;
    }

    .recipe-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .recipe-card:hover .recipe-image {
        transform: scale(1.05);
    }

    .recipe-category-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        background: rgba(239, 68, 68, 0.9);
        color: white;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        backdrop-filter: blur(10px);
    }

    .favorite-form {
        position: absolute;
        top: 12px;
        right: 12px;
        z-index: 10;
    }

    .favorite-btn {
        background: rgba(255, 255, 255, 0.9);
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
        backdrop-filter: blur(10px);
    }

    .favorite-btn svg {
        width: 20px;
        height: 20px;
        color: #9ca3af;
        transition: all 0.2s;
    }

    .favorite-btn:hover svg,
    .favorite-btn.active svg {
        color: #ef4444;
        transform: scale(1.1);
    }

    .recipe-content {
        padding: 16px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .recipe-title {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 8px;
        color: #111827;
        line-height: 1.3;
    }

    .recipe-description {
        font-size: 14px;
        color: #6b7280;
        margin-bottom: 12px;
        flex: 1;
        line-height: 1.5;
    }

    .recipe-meta {
        margin-top: auto;
    }

    .recipe-rating {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .rating-stars {
        display: flex;
        gap: 2px;
    }

    .star {
        color: #d1d5db;
        font-size: 16px;
    }

    .star.filled {
        color: #fbbf24;
    }

    .rating-value {
        font-weight: 600;
        color: #111827;
    }

    .rating-count {
        font-size: 12px;
        color: #9ca3af;
    }

    .recipe-hover-details {
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom, rgba(0,0,0,0.7), rgba(0,0,0,0.9));
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 24px;
        z-index: 5;
    }

    .hover-content {
        text-align: center;
        color: white;
    }

    .hover-description {
        font-size: 14px;
        line-height: 1.6;
        margin-bottom: 16px;
    }

    .hover-meta {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-bottom: 16px;
        font-size: 12px;
        opacity: 0.9;
    }

    .hover-button {
        background: #ef4444;
        color: white;
        padding: 10px 24px;
        border-radius: 24px;
        font-weight: 600;
        display: inline-block;
        transition: all 0.2s;
    }

    .hover-button:hover {
        background: #dc2626;
        transform: scale(1.05);
    }
</style>

