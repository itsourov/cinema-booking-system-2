<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Models\Movie;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('movies.index', [
            'movies' => Movie::filter(['genre' => request('genre')])->withCount([
                'shows' => function ($query) {
                    $query->upcoming();
                }
            ])->latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMovieRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {


        $movie = $movie->loadMissing([
            'shows' => function ($query) {
                $query->upcoming();
            }
        ])->loadCount([
            'shows' => function ($query) {
                $query->upcoming();
            }
        ]);
        if (auth()->user()) {
            $userWatchedThisMovie = in_array($movie->id, auth()->user()->movies->pluck('id')->toArray());
        } else {
            $userWatchedThisMovie = false;
        }

        $movie = $movie->loadMissing('videoReviews.user.media');
        return view('movies.show', [
            'movie' => $movie,
            'userWatchedThisMovie' => $userWatchedThisMovie,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMovieRequest $request, Movie $movie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        //
    }
}
