<?php

namespace App\Http\Controllers\Admin;


use App\Models\Genre;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGenreRequest;
use App\Http\Requests\UpdateGenreRequest;

class GenreController extends Controller
{
    /**
     * Display a listing of the genre.
     */
    public function index()
    {
        $genres = Genre::withCount('movies')->latest()->paginate(10);
        return view('admin.movies.genres', ['genres' => $genres]);
    }



    /**
     * Store a newly created genre in storage.
     */
    public function store(StoreGenreRequest $request)
    {
        Genre::create($request->validated());

        return redirect(route('admin.movies.genres'))->with('message', 'Genre submitted');
    }


}