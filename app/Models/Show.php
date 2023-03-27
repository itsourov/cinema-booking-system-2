<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Show extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'movie_id',
        'date',
        'seat',

    ];

    public function scopeUpcoming($query)
    {


        $query->whereDate('date', '>=', Carbon::now())->oldest('date');
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'seat' => 'array',
    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
