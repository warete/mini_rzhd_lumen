<?php

namespace Database\Seeders;

use App\Models\Station;
use App\Models\User;

class StationsTableSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        Station::factory()
            ->count(10)
            ->create();
    }
}
