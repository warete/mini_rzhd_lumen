<?php

namespace Database\Factories;

use App\Models\Train;
use Illuminate\Support\Str;

class TrainFactory extends \Illuminate\Database\Eloquent\Factories\Factory
{
    protected $model = Train::class;

    public function definition()
    {
        return [
            'number' => Str::random(5),
            'max_seats_cnt' => $this->faker->numberBetween(30, 50)
        ];
    }
}
