<?php

namespace Database\Seeders;

use App\Models\Route;
use App\Models\Station;
use App\Models\Ticket;
use App\Models\Train;
use App\Models\User;
use Carbon\Carbon;
use Faker\Generator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /** @var Generator */
    protected Generator $faker;

    public function __construct(Generator $faker)
    {
        $this->faker = $faker;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [];
        for ($i = 0; $i < $this->faker->numberBetween(5, 15); $i++)
        {
            $user = new User();
            $user->name = $this->faker->name;
            $user->email = $this->faker->email;
            $user->password = $this->faker->password;
            $user->save();
            $users[] = $user;
        }

        $stations = [];
        foreach ([
                     'Волгоград 1',
                     'Москва Павелецкая',
                     'Москва Киевская',
                     'Москва Курская',
                     'Санкт-Петербург Главный'
                 ] as $stationName)
        {
            $station = new Station();
            $station->name = $stationName;
            $station->save();
            $stations[] = $station;
        }

        $trains = [];
        for ($i = 0; $i < 20; $i++)
        {
            $train = new Train();
            $train->number = Str::random(5);
            $train->max_seats_cnt = $this->faker->numberBetween(30, 50);
            $train->save();
            $trains[] = $train;
        }

        foreach ($stations as $i => $stationFrom)
        {
            foreach ($stations as $j => $stationTo)
            {
                if ($i == $j)
                {
                    continue;
                }
                for ($o = 0; $o < $this->faker->numberBetween(1, 5); $o++)
                {
                    $route = new Route();
                    $route->stationFrom()->associate($stationFrom);
                    $route->stationTo()->associate($stationTo);
                    $route->price = $this->faker->numberBetween(1000, 7000);
                    $route->date_start = Carbon::now()->add($this->faker->numberBetween(-3, 20), 'day');
                    $route->date_end = $route->date_start->add($this->faker->numberBetween(1, 7), 'day');
                    $trainsForRoute = [];
                    foreach ($this->faker->randomElements($trains, 5) as $train)
                    {
                        $trainsForRoute[] = $train->id;
                    }
                    $route->save();
                    $route->trains()->attach($trainsForRoute);
                    $route->save();

                    for ($l = 0; $l < $this->faker->numberBetween(0, 10); $l++)
                    {
                        $ticket = new Ticket();
                        $ticket->is_paid = false;
                        $ticket->user()->associate($this->faker->randomElement($users));
                        $ticket->route()->associate($route);
                        $ticket->save();
                    }
                }
            }
        }
    }
}
