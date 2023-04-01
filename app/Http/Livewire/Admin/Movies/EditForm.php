<?php

namespace App\Http\Livewire\Admin\Movies;

use App\Models\Genre;
use App\Models\Movie;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class EditForm extends Component
{

    public $videoSectionOpened = false;
    public $castSectionOpened = false;
    public $crewSectionOpened = false;
    public $genreSectionOpened = true;

    public Movie $movie;
    public $genres = [];

    public $movieArray = [
        'tmdb_id' => '',
        'title' => '',
        'original_title' => '',
        'is_adult' => '',
        'release_date' => '',
        'runtime' => '',
        'images' => '',
        'poster' => '',
        'backdrop' => '',
        'trailers' => [],
        'rating' => '',
        'cast' => [],
        'crew' => [],
        'synopsis' => '',
        'certification' => 'unrated',
    ];

    protected function rules()
    {
        return [
            'movieArray.tmdb_id' =>  'unique:movies,tmdb_id,' . $this->movie->id,
            'movieArray.title' =>  'required',
            'movieArray.original_title' =>  'required',
            'movieArray.is_adult' =>  '',
            'movieArray.release_date' =>  'date',
            'movieArray.images' =>  '',
            'movieArray.trailers' =>  '',
            'movieArray.cast' =>  '',
            'movieArray.crew' =>  '',
            'movieArray.poster' =>  '',
            'movieArray.backdrop' =>  '',
            'movieArray.synopsis' =>  '',
            'movieArray.rating' =>  '',
            'movieArray.runtime' =>  '',
            'movieArray.certification' =>  'required',
        ];
    }

    public function render()
    {
        return view('livewire.admin.movies.edit-form');
    }
    public function mount(Movie $movie)
    {
        $this->movie = $movie;
        $this->genres = json_decode($movie->genres);
        $this->movieArray = $movie->toArray();
    }




    public function videoSectionToggle()
    {
        $this->videoSectionOpened = !$this->videoSectionOpened;
    }
    public function castSectionToggle()
    {
        $this->castSectionOpened = !$this->castSectionOpened;
    }
    public function crewSectionToggle()
    {
        $this->crewSectionOpened = !$this->crewSectionOpened;
    }

    public function genreSectionToggle()
    {
        $this->genreSectionOpened = !$this->genreSectionOpened;
    }
    public function removeVideo($index)
    {

        unset($this->movieArray['trailers'][$index]);
    }
    public function removeCast($index)
    {

        unset($this->movieArray['cast'][$index]);
    }
    public function removeCrew($index)
    {

        unset($this->movieArray['crew'][$index]);
    }

    public function removeGenre($index)
    {

        unset($this->genres[$index]);
    }
    public function addNewVideo()
    {
        array_push($this->movieArray['trailers'], []);
    }
    public function addNewCast()
    {
        array_push($this->movieArray['cast'], [
            'profile_path' => '',
            'name' => '',
            'character' => '',
        ]);
    }
    public function addNewCrew()
    {
        array_push($this->movieArray['crew'], ['job' => 'Director']);
    }

    public function addNewGenre()
    {
        array_push($this->genres, ['title' => '', 'tmdb_id' => '']);
    }



    public function getInfo()
    {
        $this->validate(['movieArray.tmdb_id' => ['required']]);
        $movieid = $this->movieArray['tmdb_id'];
        $movieJson = cache()->remember($movieid, 60 * 60, function () use ($movieid) {

            $movieRes = Http::accept('application/json')->withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/' . $movieid . '?append_to_response=release_dates');
            if (!$movieRes->successful()) {
                return false;
            }
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
        if (!$movieJson) {
            return $this->addError('movieArray.tmdb_id', 'Invalid id');
        }



        $movie = $movieJson;
        // dd($movie);


        $certification = 'Unrated';
        foreach ($movie->release_dates->results as $cReleases) {
            if ($cReleases->iso_3166_1 == 'US') {
                $certification = $cReleases->release_dates[0]->certification;
            }
        }

        $this->movieArray =    [
            'tmdb_id' => $movie->id,
            'title' => $movie->title,
            'original_title' => $movie->title,
            'is_adult' => $movie->adult,
            'release_date' => $movie->release_date,
            'runtime' => $movie->runtime,
            'images' => ($movie->image->backdrops),
            'poster' => $movie->poster_path,
            'backdrop' => $movie->backdrop_path,
            'trailers' => json_decode(
                json_encode($movie->video->results),
                true
            ),
            'rating' => ($movie->vote_average),
            'cast' => json_decode(
                json_encode(($movie->credits->cast)),
                true
            ),
            'crew' => json_decode(
                json_encode(($movie->credits->crew)),
                true
            ),
            'synopsis' => ($movie->overview),
            'certification' => $certification,
        ];

        $this->genres = [];
        foreach ($movie->genres as $key => $genre) {
            array_push($this->genres, ['title' => $genre->name, 'tmdb_id' => $genre->id]);
        }
    }

    public function SaveNewMovie()
    {

        $validatedGenres =  $this->validate([
            'genres' => 'array', // Will make sure the the product_options is an array and has at least one element
            'genres.*.title' =>  'distinct|required|min:3',
            'genres.*.tmdb_id' =>  'distinct',
        ]);


        $validatedData =  $this->validate();
        if (empty($validatedData['movieArray']['tmdb_id'])) {
            $validatedData['movieArray']['tmdb_id'] = null;
        }



        DB::beginTransaction();


        $this->movie->update($validatedData['movieArray']);


        $genreIds = [];
        foreach ($validatedGenres['genres'] as  $genre) {
            // dd($genre);
            $newGenre =  Genre::firstOrCreate($genre, $genre);
            array_push($genreIds, $newGenre->id);
        }
        $this->movie->genres()->sync($genreIds);

        DB::commit();
        return redirect(route('movies.show', $this->movie->id));
    }
}
