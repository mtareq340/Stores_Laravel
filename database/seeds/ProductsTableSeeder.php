<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void 
     */
    public function run()
    {
        // Role::truncate();
        Product::create(['category_id' => 1, 'name'=>'نفخ هواء']);
        Product::create(['category_id' => 2, 'name'=>'لحام كاوتش']);
        Product::create(['category_id' => 3, 'name'=>'الترصيص']);

    }
}
