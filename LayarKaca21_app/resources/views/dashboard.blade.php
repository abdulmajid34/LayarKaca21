<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('LayarKaca21') }}
            </h2>
            
            <div class="flex space-x-2">
                <a href="{{ route('switch.language', 'en') }}" class="px-3 py-1 text-sm rounded {{ app()->getLocale() == 'en' ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-800' }}">EN</a>
                <a href="{{ route('switch.language', 'id') }}" class="px-3 py-1 text-sm rounded {{ app()->getLocale() == 'id' ? 'bg-red-600 text-white' : 'bg-gray-200 text-gray-800' }}">ID</a>
            </div>
        </div>
    </x-slot>

    {{-- Carousel CSS --}}
    <link rel="stylesheet" href="{{ asset('css/movie-carousel.css') }}">

    <div class="py-8 bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Hero Banner --}}
            @if(count($recommendations) > 0)
                <div class="mb-10 px-4 sm:px-0">
                   <div class="relative h-96 rounded-xl overflow-hidden shadow-2xl">
                       @php $heroMovie = $recommendations[0]; @endphp
                       <img src="https://image.tmdb.org/t/p/original{{ $heroMovie['backdrop_path'] }}" class="absolute w-full h-full object-cover opacity-50">
                       <div class="absolute bottom-0 left-0 p-8 bg-gradient-to-t from-black via-black/70 to-transparent w-full">
                           <h1 class="text-4xl font-bold text-white mb-2">{{ $heroMovie['title'] }}</h1>
                           <p class="text-gray-200 line-clamp-2 max-w-2xl mb-4">{{ $heroMovie['overview'] }}</p>
                           <button class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition">Watch Trailer</button>
                       </div>
                   </div>
                </div>
            @endif

            {{-- Movie Carousels --}}
            @include('components.movie-carousel', ['title' => 'Rekomendasi Untukmu', 'movies' => $recommendations])
            @include('components.movie-carousel', ['title' => 'Sedang Tayang', 'movies' => $nowPlaying])
            @include('components.movie-carousel', ['title' => 'Populer Saat Ini', 'movies' => $popular])
            @include('components.movie-carousel', ['title' => 'Rating Tertinggi', 'movies' => $topRated])
            @include('components.movie-carousel', ['title' => 'Akan Datang', 'movies' => $upcoming])

        </div>
    </div>

    {{-- Carousel JS --}}
    <script src="{{ asset('js/movie-carousel.js') }}"></script>
</x-app-layout>