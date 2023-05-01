<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\VideoReview;
use Illuminate\Http\Request;
use App\Http\Requests\StoreVideoReviewRequest;
use App\Http\Requests\UpdateVideoReviewRequest;

class VideoReviewController extends Controller
{
    /**
     * Display a listing of the video-review.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new video-review.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created video-review in storage.
     */
    public function store(Movie $movie, Request $request)
    {

        $validated = $request->validate([
            'reviewVideo' =>
            'mimes:mp4,mov,ogg,qt | max:10000| required',

        ]);
        if ($request->hasFile('reviewVideo')) {

            $file = $request->file('reviewVideo');
            $filename = $movie->id . '_' . auth()->user()->id . '.mp4';
            $path = storage_path() . '/app/public/review-video/';
            $file->move($path, $filename);

            VideoReview::updateOrCreate(
                [
                    'user_id' => auth()->user()->id,
                    'movie_id' => $movie->id,
                ],
                [
                    'video' => 'storage/review-video/' . $filename,
                    'user_id' => auth()->user()->id,
                    'movie_id' => $movie->id,
                    'source' => 0,

                ]
            );

            return redirect(route('movies.show', $movie->id))->with('message', 'Review submitted');
        }
    }

    /**
     * Display the specified video-review.
     */
    public function show(VideoReview $videoReview)
    {
        //
    }

    /**
     * Show the form for editing the specified video-review.
     */
    public function edit(VideoReview $videoReview)
    {
        //
    }

    /**
     * Update the specified video-review in storage.
     */
    public function update(Request $request, VideoReview $videoReview)
    {
        //
    }

    /**
     * Remove the specified video-review from storage.
     */
    public function destroy(VideoReview $videoReview)
    {
        //
    }
}