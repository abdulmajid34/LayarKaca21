<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            
            <div class="flex space-x-2">
                <a href="{{ route('switch.language', 'en') }}" 
                   class="px-3 py-1 rounded {{ app()->getLocale() == 'en' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-800' }}">
                   English
                </a>
                <a href="{{ route('switch.language', 'id') }}" 
                   class="px-3 py-1 rounded {{ app()->getLocale() == 'id' ? 'bg-red-600 text-white' : 'bg-gray-200 text-gray-800' }}">
                   Indonesia
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">
            
            @include('components.movie-section', ['title' => 'Now Playing', 'movies' => $nowPlaying])

            @include('components.movie-section', ['title' => 'Popular', 'movies' => $popular])

            @include('components.movie-section', ['title' => 'Top Rated', 'movies' => $topRated])

            @include('components.movie-section', ['title' => 'Upcoming', 'movies' => $upcoming])

        </div>
    </div>
</x-app-layout>