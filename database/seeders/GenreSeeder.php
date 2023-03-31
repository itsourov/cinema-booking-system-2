<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Genre::factory(8)->create();


        // foreach (Genre::get() as $genre) {
        //     $movies = Movie::inRandomOrder()->take(rand(4, 8))->pluck('id');
        //     $genre->movies()->attach($movies);
        // }
    }
}