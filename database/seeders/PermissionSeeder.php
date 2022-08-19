<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissionsList = [
            'can create any post', 
            'can edit any post',
            'can view any post',
            'can delete any post',
            'can change status of any post',
            'can create only own post',
            'can edit only own post',
            'can view only own post',
            'can delete only own post',
            'can change status of only own post',
        ];

        foreach ($permissionsList as $item) {
            $permission = new Permission();
            $permission->name = $item;
            $permission->save();
        }
    }
}
