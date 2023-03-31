<?php

namespace App\Models;

use App\Models\User;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = [
        'tmdb_id',
        'title',

    ];
    public function movies()
    {
        return $this->belongsToMany(Movie::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function watchedItems()
    {
        return $this->movies()->whereHas('users', function ($q) {
            $q->where('user_id', auth()->user()->id);
        });
    }
}
