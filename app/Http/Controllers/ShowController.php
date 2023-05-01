<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Show;
use App\Http\Requests\StoreShowRequest;
use App\Http\Requests\UpdateShowRequest;

class ShowController extends Controller
{
    /**
     * Display a listing of the show.
     */
    public function index()
    {
        $dateTime = Carbon::now()->toDateTimeString();

        $shows = Show::upcoming()->with('movie')->paginate(10);

        return view('shows.index', [
            'shows' => $shows,
            'dateTime' => $dateTime,
        ]);
    }

    /**
     * Show the form for creating a new show.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created show in storage.
     */
    public function store(StoreShowRequest $request)
    {
        //
    }

    /**
     * Display the specified show.
     */
    public function show(Show $show)
    {

        $dateTime = Carbon::now()->toDateTimeString();
        return view('shows.details', [
            'show' => $show,
            'dateTime' => $dateTime,
        ]);
    }

    /**
     * Show the form for editing the specified show.
     */
    public function edit(Show $show)
    {
        //
    }

    /**
     * Update the specified show in storage.
     */
    public function update(UpdateShowRequest $request, Show $show)
    {
        //
    }

    /**
     * Remove the specified show from storage.
     */
    public function destroy(Show $show)
    {
        //
    }
}