<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Show;
use App\Http\Requests\StoreShowRequest;
use App\Http\Requests\UpdateShowRequest;

class ShowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dateTime =  Carbon::now()->toDateTimeString();

        $shows = Show::upcoming()->with('movie')->paginate(10);

        return view('shows.index', [
            'shows' => $shows,
            'dateTime' => $dateTime,
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
    public function store(StoreShowRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Show $show)
    {

        $dateTime =  Carbon::now()->toDateTimeString();
        return view('shows.details', [
            'show' => $show,
            'dateTime' => $dateTime,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Show $show)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShowRequest $request, Show $show)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Show $show)
    {
        //
    }
}
