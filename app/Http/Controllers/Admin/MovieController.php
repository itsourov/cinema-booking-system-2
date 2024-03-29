<?php

namespace App\Http\Controllers\Admin;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Models\Genre;
use Illuminate\Support\Facades\Redirect;

class MovieController extends Controller
{
    /**
     * Display a listing of the movie.
     */
    public function index()
    {
        $movie = Movie::latest()->paginate(10);


        return view('admin.movies.index', [
            'movies' => $movie
        ]);
    }

    /**
     * Show the form for creating a new movie.
     */
    public function create()
    {
        $genres = Genre::all();
        return view('admin.movies.create', [
            'genres' => $genres,
        ]);
    }

    /**
     * Store a newly created movie in storage.
     */
    public function store(StoreMovieRequest $request)
    {
        $movie = Movie::create($request->validated());
        $movie->genres()->sync($request->genres);
        return redirect(route('admin.movies'))->with('message', 'Movie submitted');
    }

    /**
     * Display the specified movie.
     */
    public function show(Movie $movie)
    {
    }

    /**
     * Show the form for editing the specified movie.
     */
    public function edit(Movie $movie)
    {
        $genres = Genre::all();
        return view('admin.movies.edit', [
            'movie' => $movie,
            'genres' => $genres,
        ]);
    }

    /**
     * Update the specified movie in storage.
     */
    public function update(UpdateMovieRequest $request, Movie $movie)
    {

        $movie->update($request->validated());
        $movie->genres()->sync($request->genres);

        return redirect(route('admin.movies'))->with('message', 'Movie Updated');
    }

    /**
     * Remove the specified movie from storage.
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();
        return redirect(route('admin.movies'))->with('message', 'Movie deleted');
    }
}