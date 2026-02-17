<?php

namespace App\Http\Controllers;

use App\Services\TmdbService;
use Illuminate\View\View;

class DashboardController extends Controller
{
    protected $tmdb;

    // Dependency Injection Service
    public function __construct(TmdbService $tmdb)
    {
        $this->tmdb = $tmdb;
    }

    public function index(): View
    {
        // Kita gunakan Trending sebagai "Recommendations" untuk halaman utama
        $recommendations = $this->tmdb->getTrending();
        $nowPlaying = $this->tmdb->getNowPlaying();
        $popular = $this->tmdb->getPopular();
        $topRated = $this->tmdb->getTopRated();
        $upcoming = $this->tmdb->getUpcoming();

        return view('dashboard', compact('recommendations', 'nowPlaying', 'popular', 'topRated', 'upcoming'));
    }
}