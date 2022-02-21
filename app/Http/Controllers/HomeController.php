<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $popularMovies = Movie::where('type', null)
            ->limit(5)
            ->orderBy('vote_count', 'desc')
            ->get();

        $nowPlayingMovies = Movie::where('type', 'now_playing')
            ->limit(5)
            ->orderBy('vote_count', 'desc')
            ->get();

        $upcomingMovies = Movie::where('type', 'upcoming')
            ->limit(5)
            ->orderBy('vote_count', 'desc')
            ->get();

        return view('home', compact('popularMovies', 'upcomingMovies', 'nowPlayingMovies'));
    }

    public function topStatistics()
    {
        $genresCount = number_format(genre::count(), 1);
        $moviesCount = number_format(Movie::count(), 1);
        $actorsCount = number_format(Actor::count(), 1);

        return response()->json([
            'genres_count' => $genresCount,
            'movies_count' => $moviesCount,
            'actors_count' => $actorsCount,
        ]);
    } // end of topStatistics

    public function moviesChart()
    {
        $movies = Movie::whereYear('release_date', request()->year)
            ->select(
                '*',
                DB::raw('MONTH(release_date) as month'),
                DB::raw('YEAR(release_date) as year'),
                DB::raw('COUNT(id) as total_movies'),
            )
            ->groupBy('month')
            ->get();

        return view('_movies_chart', compact('movies'));
    } // end of moviesChart
}