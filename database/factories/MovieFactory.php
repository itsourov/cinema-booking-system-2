<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Xylis\FakerCinema\Provider\Movie($faker));

        return [
            'title' => $faker->movie,
            'poster_link' => fake()->imageUrl(500, 750),
            'synopsis' => fake()->paragraph(1),
            'release_date' => fake()->date(),
            'trailer_link' => 'https://youtu.be/jNQXAC9IVRw',

        ];
    }
}
