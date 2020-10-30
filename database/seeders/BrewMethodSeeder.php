<?php

namespace Database\Seeders;

use App\Models\BrewMethod;
use Illuminate\Database\Seeder;

class BrewMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BrewMethod::factory()->times(7 )->create();
    }
}
