<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
    <h3 class="text-2xl font-bold mb-4 text-gray-900 dark:text-gray-100">{{ $title }}</h3>
    
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
        @foreach($movies as $movie)
            <div class="group relative">
                <div class="aspect-[2/3] w-full overflow-hidden rounded-md bg-gray-200 group-hover:opacity-75 lg:aspect-none lg:h-80">
                    <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" 
                         alt="{{ $movie['title'] }}" 
                         class="h-full w-full object-cover object-center lg:h-full lg:w-full">
                </div>
                
                <div class="mt-4 flex justify-between">
                    <div>
                        <h3 class="text-sm font-medium text-gray-700 dark:text-gray-200">
                            <a href="#">
                                <span aria-hidden="true" class="absolute inset-0"></span>
                                {{ $movie['title'] }}
                            </a>
                        </h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            {{ \Carbon\Carbon::parse($movie['release_date'])->format('Y') }}
                        </p>
                    </div>
                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100">
                        ⭐ {{ number_format($movie['vote_average'], 1) }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</div>