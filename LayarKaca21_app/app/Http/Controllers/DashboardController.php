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
        // Ambil data parallel (opsional: bisa dioptimasi nanti)
        $nowPlaying = $this->tmdb->getNowPlaying();
        $popular = $this->tmdb->getPopular();
        $topRated = $this->tmdb->getTopRated();
        $upcoming = $this->tmdb->getUpcoming();

        return view('dashboard', compact('nowPlaying', 'popular', 'topRated', 'upcoming'));
    }
}