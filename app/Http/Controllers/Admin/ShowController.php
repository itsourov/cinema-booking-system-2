<?php

namespace App\Http\Controllers\Admin;

use stdClass;
use Carbon\Carbon;
use App\Models\Show;
use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreShowRequest;
use App\Http\Requests\UpdateShowRequest;

class ShowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shows = Show::with('movie')->latest()->paginate(10);


        $dateTime =  Carbon::now()->toDateTimeString();

        return view('admin.shows.index', [
            'shows' => $shows,
            'dateTime' => $dateTime,
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function upcoming()
    {
        $shows = Show::with('movie')->upcoming()->paginate(10);

        $dateTime =  Carbon::now()->toDateTimeString();

        return view('admin.shows.index', [
            'shows' => $shows,
            'dateTime' => $dateTime,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Movie $movie)
    {
        $movie = $movie->loadCount([
            'shows' => function ($query) {
                $query->upcoming();
            }
        ]);
        return view('admin.shows.create', [
            'movie' => $movie,

        ]);
    }

    public function createGuide()
    {
        return view('admin.shows.create2');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShowRequest $request, Movie $movie)
    {





        $seats =  new stdClass();
        foreach (range('A', 'H') as $v) {
            $row =  new stdClass();

            for ($j = 0; $j < 8; $j++) {
                $status = ['booked', 'available',  'blocked', 'available'];
                $seat =  new stdClass();
                // $seat->status = $status[rand(0, 3)];
                $seat->status = 'available';
                $seat->price = $request->ticket_price;

                $row->$j = $seat;
            }
            $seats->$v = $row;
        }
        $show =  Show::create(array_merge($request->validated(), ['movie_id' => $movie->id, 'seat' => json_encode($seats)]));



        return redirect(route('admin.shows'))->with('message', 'Show submitted');
    }

    /**
     * Display the specified resource.
     */
    public function show(Show $show)
    {
        // return json_decode($show->seat);
        return view('admin.shows.details', [
            'show' => $show,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Show $show)
    {

        return view('admin.shows.edit', [
            'show' => $show,

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShowRequest $request, Show $show)
    {

        // return $request;
        $show->update($request->validated());


        return redirect(route('admin.shows'))->with('message', 'Show Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Show $show)
    {
        $show->delete();
        return redirect(route('admin.shows'))->with('message', 'Show deleted');
    }
}
