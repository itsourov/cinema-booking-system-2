<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'seat_number',
        'payment_status',
        'user_id',
        'show_id',
        'paid_amount',
        'payment_time',


    ];

    protected $casts = [
        'seat_number' => 'array',
    ];

    // Relationship To User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    // Relationship To Show
    public function show()
    {
        return $this->belongsTo(Show::class, 'show_id');
    }
}
