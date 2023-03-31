<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function test()
    {

        return view('test');
        $response = cache()->remember('popular-moviessad', 60 * 60, function () {

            $response = Http::accept('application/json')->withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/popular');

            return json_decode($response);
        });


        foreach ($response->results as $movie) {
            $movieid = $movie->id;
            $movieRes = Http::accept('application/json')->withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/' . $movieid . '?append_to_response=release_dates');

            return json_decode($movieRes);

            $movieJson = cache()->remember($movieid, 60 * 60, function () use ($movieid) {

                $movieRes = Http::accept('application/json')->withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/' . $movieid . '?append_to_response=release_dates');

                $imageRes = Http::accept('application/json')->withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/' . $movieid . '/images');
                $videoRes = Http::accept('application/json')->withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/' . $movieid . '/videos');
                $creditRes = Http::accept('application/json')->withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/' . $movieid . '/credits');

                $movieJson =  json_decode($movieRes);
                $creditJson =  json_decode($creditRes);
                $videoJson =  json_decode($videoRes);
                $imageJson =  json_decode($imageRes);

                $movieJson->credits = $creditJson;
                $movieJson->video = $videoJson;
                $movieJson->image = $imageJson;

                return $movieJson;
            });

            $movie = $movieJson;
            return $movie;
        }
    }
}
