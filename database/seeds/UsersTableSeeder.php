<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::truncate();
        // DB::table('user_role')->truncate();

        $adminRole = Role::where('title','admin')->first();
        $cacheirRole = Role::where('title','cacheir')->first();
        $storeRole = Role::where('title','store')->first();

        $admin = User::create([
            'name' =>'الادمن الاول',
            'email' =>'admin@admin.com',
            'admin' => 1,
            'password'=>bcrypt('123456'),
        ]);
        $cacheir = User::create([
            'name' =>'الكاشير الاول',
            'store_id' => 3,
            'email' =>'cacheir@cacheir.com',
            'password'=>bcrypt('123456'),
        ]);
        $store = User::create([
            'name' =>'المتجر الاول',
            'email' =>'store@store.com',
            'password'=>bcrypt('123456'),
        ]);

        $admin->roles()->attach($adminRole);
        $cacheir->roles()->attach($cacheirRole);
        $store->roles()->attach($storeRole);
    }
}
