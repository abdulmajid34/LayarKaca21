<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TmdbService
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('services.tmdb.base_url');
        $this->apiKey = config('services.tmdb.api_key');
    }

    // Helper untuk request ke API
    protected function get($endpoint, $params = [])
    {
        // Mapping Laravel Locale (en/id) ke TMDB Locale (en-US/id-ID)
        $currentLocale = app()->getLocale();
        $tmdbLanguage = $currentLocale === 'id' ? 'id-ID' : 'en-US';

        $defaultParams = [
            'api_key' => $this->apiKey,
            'language' => $tmdbLanguage, // Dinamis berdasarkan session
        ];

        // Merge params: jika controller kirim page/query, itu akan menimpa default
        $response = Http::get($this->baseUrl . $endpoint, array_merge($defaultParams, $params));

        return $response->json();
    }

    // --- Method untuk Data Dashboard ---

    public function getNowPlaying()
    {
        return $this->get('/movie/now_playing')['results'] ?? [];
    }

    public function getPopular()
    {
        return $this->get('/movie/popular')['results'] ?? [];
    }

    public function getTopRated()
    {
        return $this->get('/movie/top_rated')['results'] ?? [];
    }

    public function getUpcoming()
    {
        return $this->get('/movie/upcoming')['results'] ?? [];
    }
}