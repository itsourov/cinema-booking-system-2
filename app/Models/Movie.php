<?php

namespace App\Models;

use App\Models\Genre;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'poster_link',
        'synopsis',
        'release_date',
        'trailer_link',
    ];

    protected $dates = ['release_date'];


    public function scopeFilter($query, array $filters)
    {



        if ($filters['genre'] ?? false) {
            $genre = $filters['genre'];
            $query->whereHas('genres', function ($q) use ($genre) {
                $q->where('genre_id', $genre);
            });
        }
    }



    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }
    public function shows()
    {
        return $this->hasMany(Show::class);
    }
}
