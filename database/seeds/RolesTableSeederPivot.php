<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeederPivot extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void 
     */
    public function run()
    {
        $items = [
            
            1 => [
                'permission' => [1, 2, 3, 4, 5, 6, 7, 8, 9,10, 11, 12, 13],
            ],
            // 2 => [
            //     'permission' => [1,2,3,4,5],
            // ],
            // 3 => [
            //     'permission' => [1,2,3],
            // ],

        ];

        foreach ($items as $id => $item) {
            $role = \App\Role::find($id);

            foreach ($item as $key => $ids) {
                $role->{$key}()->sync($ids);
            }
        }
    }
}
