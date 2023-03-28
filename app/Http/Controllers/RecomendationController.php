<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RecomendationController extends Controller
{
    public function index()
    {

        $genres = auth()->user()->genres->loadMissing(['movies.genres' => function ($query1) {
            $query1->whereNot(function ($query) {
                $query->whereHas('users', function ($q) {
                    $q->where('user_id', auth()->user()->id);
                });
            });
        }, 'watchedItems',]);

        // return $genres;
        return view('recomendation.index', [
            'genres' => $genres,
        ]);
    }
}
