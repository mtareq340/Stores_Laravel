<?php

use Illuminate\Database\Seeder;
use App\Technical;

class TechnicalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void 
     */
    public function run()
    {
        Technical::create(['store_id' => 3, 'name'=>'محمد محمود السيد', 'email'=>'mohamed@technical.com', 'phone'=>'01013115444']);
        Technical::create(['store_id' => 3, 'name'=>'اسلام احمد رضوان', 'email'=>'eslam@technical.com', 'phone'=>'01254552525']);
        Technical::create(['store_id' => 3, 'name'=>'رضا الونش محسن', 'email'=>'reda@technical.com', 'phone'=>'01254555556']);
  

    }
}
