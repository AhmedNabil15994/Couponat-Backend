<?php

namespace Modules\Area\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Area\Entities\State;

class SeedStatesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($state , $city)
    {
            State::create(['title' => $state, 'status' => 1,'city_id' => $city->id]);
    }
}
