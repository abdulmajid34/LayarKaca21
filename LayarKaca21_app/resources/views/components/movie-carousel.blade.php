@props(['title' => '', 'movies' => []])

@php
    $carouselId = 'carousel-' . \Illuminate\Support\Str::slug($title) . '-' . uniqid();
@endphp

<div class="movie-carousel-section">
    {{-- Header --}}
    <div class="carousel-header">
        <div class="carousel-title-wrapper">
            <div class="carousel-accent-bar"></div>
            <h2 class="carousel-title">{{ $title }}</h2>
        </div>
        <div class="carousel-nav-buttons">
            <button class="carousel-btn carousel-btn-prev" onclick="scrollCarousel('{{ $carouselId }}', 'prev')" aria-label="Previous">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </button>
            <button class="carousel-btn carousel-btn-next" onclick="scrollCarousel('{{ $carouselId }}', 'next')" aria-label="Next">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </button>
        </div>
    </div>

    {{-- Carousel Track --}}
    <div class="carousel-wrapper">
        <div class="carousel-track" id="{{ $carouselId }}">
            @foreach($movies as $movie)
                <div class="movie-card">
                    <div class="movie-card-poster">
                        @if(!empty($movie['poster_path']))
                            <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" 
                                 alt="{{ $movie['title'] ?? 'Movie' }}" 
                                 loading="lazy">
                        @else
                            <div class="movie-card-no-poster">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="2" width="20" height="20" rx="2.18" ry="2.18"></rect>
                                    <line x1="7" y1="2" x2="7" y2="22"></line>
                                    <line x1="17" y1="2" x2="17" y2="22"></line>
                                    <line x1="2" y1="12" x2="22" y2="12"></line>
                                    <line x1="2" y1="7" x2="7" y2="7"></line>
                                    <line x1="2" y1="17" x2="7" y2="17"></line>
                                    <line x1="17" y1="7" x2="22" y2="7"></line>
                                    <line x1="17" y1="17" x2="22" y2="17"></line>
                                </svg>
                                <span>No Image</span>
                            </div>
                        @endif

                        {{-- Rating Badge --}}
                        <div class="movie-card-rating">
                            <span class="rating-star">★</span>
                            <span class="rating-value">{{ number_format($movie['vote_average'] ?? 0, 1) }}</span>
                        </div>

                        {{-- Hover Overlay --}}
                        <div class="movie-card-overlay">
                            <p class="movie-card-overview">{{ \Illuminate\Support\Str::limit($movie['overview'] ?? '', 100) }}</p>
                            <button class="movie-card-detail-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <polygon points="5 3 19 12 5 21 5 3"></polygon>
                                </svg>
                                Detail
                            </button>
                        </div>
                    </div>

                    {{-- Card Info --}}
                    <div class="movie-card-info">
                        <h3 class="movie-card-title" title="{{ $movie['title'] ?? '' }}">{{ $movie['title'] ?? 'Unknown' }}</h3>
                        <div class="movie-card-meta">
                            <span class="movie-card-year">
                                @if(!empty($movie['release_date']))
                                    {{ \Carbon\Carbon::parse($movie['release_date'])->format('Y') }}
                                @else
                                    N/A
                                @endif
                            </span>
                            <span class="movie-card-lang">{{ strtoupper($movie['original_language'] ?? '') }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Gradient Edges --}}
        <div class="carousel-fade carousel-fade-left"></div>
        <div class="carousel-fade carousel-fade-right"></div>
    </div>
</div>