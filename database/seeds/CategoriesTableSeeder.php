<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void 
     */
    public function run()
    {
        // Role::truncate();
        Category::create(['name' => 'الهواء']);
        Category::create(['name' => 'اللحام']);
        Category::create(['name' => 'الترصيص']);
   
    }
}
