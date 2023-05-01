<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGenreRequest;
use App\Http\Requests\UpdateGenreRequest;
use App\Models\Genre;

class GenreController extends Controller
{
    /**
     * Display a listing of the genre.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new genre.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created genre in storage.
     */
    public function store(StoreGenreRequest $request)
    {
        //
    }

    /**
     * Display the specified genre.
     */
    public function show(Genre $genre)
    {
        //
    }

    /**
     * Show the form for editing the specified genre.
     */
    public function edit(Genre $genre)
    {
        //
    }

    /**
     * Update the specified genre in storage.
     */
    public function update(UpdateGenreRequest $request, Genre $genre)
    {
        //
    }

    /**
     * Remove the specified genre from storage.
     */
    public function destroy(Genre $genre)
    {
        //
    }
}