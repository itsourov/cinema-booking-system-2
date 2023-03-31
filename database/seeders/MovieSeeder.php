<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\Movie::factory(20)->create();

        $response = cache()->remember('popular-movies', 60 * 60, function () {

            $response = Http::accept('application/json')->withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/popular');

            return json_decode($response);
        });

        foreach ($response->results as $movie) {
            $movieid = $movie->id;
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
            $certification = 'Unrated';
            foreach ($movie->release_dates->results as $cReleases) {
                if ($cReleases->iso_3166_1 == 'US') {
                    $certification = $cReleases->release_dates[0]->certification;
                }
            }
            $newMovie =    Movie::create([
                'tmdb_id' => $movie->id,
                'title' => $movie->title,
                'original_title' => $movie->title,
                'is_adult' => $movie->adult,
                'release_date' => $movie->release_date,
                'runtime' => $movie->runtime,
                'images' => ($movie->image->backdrops),
                'poster' => $movie->poster_path,
                'backdrop' => $movie->backdrop_path,
                'trailers' => ($movie->video->results),
                'rating' => ($movie->vote_average),
                'cast' => ($movie->credits->cast),
                'crew' => ($movie->credits->crew),
                'synopsis' => ($movie->overview),
                'certification' => $certification,
            ]);

            $genreIds = [];
            foreach ($movie->genres as  $genre) {
                $newGenre =  Genre::firstOrCreate(['tmdb_id' => $genre->id, 'title' => $genre->name], ['tmdb_id' => $genre->id, 'title' => $genre->name]);
                array_push($genreIds, $newGenre->id);
            }
            $newMovie->genres()->sync($genreIds);
        }
    }
}
