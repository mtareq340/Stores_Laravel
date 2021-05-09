<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void 
     */
    public function run()
    {
        // Role::truncate();
        $items = [
            
            ['id' => 1, 'title' => 'عرض_الاقسام',],
            ['id' => 2, 'title' => 'عرض_الخدمات',],
            ['id' => 3, 'title' => 'عرض_المناطق',],
            ['id' => 4, 'title' => 'عرض_الفروع',],
            ['id' => 5, 'title' => 'عرض_المخزن',],
            ['id' => 6, 'title' => 'عرض_الموردين',],
            ['id' => 7, 'title' => 'عرض_طلبات_الموردين',],
            ['id' => 8, 'title' => 'عرض_العمالة',],
            ['id' => 9, 'title' => 'عرض_مديرين_الفروع',],
            ['id' => 10, 'title' => 'عرض_الفواتير',],
            ['id' => 11, 'title' => 'عرض_العملاء',],
            ['id' => 12, 'title' => 'عرض_الوان_السيارات',],
            ['id' => 13, 'title' => 'عرض_المستخدمين',],
    

        ];

        foreach ($items as $item) {
            \App\Permission::create($item);
        }
    }
}
