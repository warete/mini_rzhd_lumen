<?php

namespace Database\Factories;

use App\Models\Station;

class StationFactory extends \Illuminate\Database\Eloquent\Factories\Factory
{
    protected $model = Station::class;

	/**
	 * @inheritDoc
	 */
	public function definition()
	{
        return [
            'name' => $this->faker->city
        ];
	}
}
