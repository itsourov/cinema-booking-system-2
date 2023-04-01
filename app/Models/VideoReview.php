<?php

namespace App\Models;

use App\Models\User;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VideoReview extends Model
{
    use HasFactory;



    protected $fillable = [
        'video',
        'user_id',
        'movie_id',
        'source',



    ];
    // Relationship To User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship To User
    public function movie()
    {
        return $this->belongsTo(Movie::class, 'movie_id');
    }
    public function videoUrl()
    {

        if ($this->source == 0) {
            return asset($this->video);
        } else {
            return $this->video;;
        }
    }
}
