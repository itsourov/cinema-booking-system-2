<?php

namespace Database\Factories;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VideoReview>
 */
class VideoReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::get()->random()->id,
            'movie_id' => Movie::get()->random()->id,
            'video' => 'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerMeltdowns.mp4',
            'source' => 0
        ];
    }
}