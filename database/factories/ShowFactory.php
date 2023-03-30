<?php

namespace Database\Factories;


use stdClass;
use Carbon\Carbon;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Show>
 */
class ShowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $movie =
            Movie::get()->random();;


        $seats =  new stdClass();
        foreach (range('A', 'H') as $v) {
            $row =  new stdClass();

            for ($j = 0; $j < 8; $j++) {
                $status = ['booked', 'available',  'blocked', 'available'];
                $seat =  new stdClass();
                // $seat->status = $status[rand(0, 3)];
                $seat->status = 'available';
                $seat->price = 300;

                $row->$j = $seat;
            }
            $seats->$v = $row;
        }



        return [
            'movie_id' => $movie->id,
            'title' => $movie->title . " Premier",
            'date' => Carbon::now()->addHours(rand(3, 12))->addMinute(rand(1, 59))->toDateTimeString(),
            'seat' => json_encode($seats),
            'virtual_ticket_price' => 20,
        ];
    }
}
