<?php

use Illuminate\Database\Seeder;
use App\Carcolor;

class CarColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void 
     */
    public function run()
    {
        Carcolor::create(['name' => 'احمر']);
        Carcolor::create(['name' => 'رصاصي']);
        Carcolor::create(['name' => 'ابيض']);
    }
}
