<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\ShowSeeder;
use Database\Seeders\GenreSeeder;
use Database\Seeders\MovieSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'role' => 'admin',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password

        ]);


        // \App\Models\User::factory(10)->create();
        $this->call(MovieSeeder::class);
        $this->call(GenreSeeder::class);
        $this->call(ShowSeeder::class);
        $this->call(FoodSeeder::class);
    }
}
