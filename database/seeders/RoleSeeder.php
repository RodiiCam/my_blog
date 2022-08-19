<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rolesList = [
            'admin' => [
                'hierarchy' => 1,
                'permissions' => [
                    'can create any post', 
                    'can edit any post',
                    'can view any post',
                    'can delete any post',
                    'can change status of any post',
                ]
            ],
            'editor' => [
                'hierarchy' => 2,
                'permissions' => [
                    'can create only own post',
                    'can edit only own post',
                    'can view only own post',
                    'can delete only own post',
                    'can change status of only own post',
                ]
            ]
        ];

        $permissionsList = Permission::get();

        foreach ($rolesList as $roleName => $roleVal) {
            $role = new Role();
            $role->name = $roleName;
            $role->hierarchy = $roleVal['hierarchy'];
            $role->save();

            foreach ($permissionsList as $permission) {
                if (in_array($permission->name, $roleVal['permissions'])) {
                    $role->permission()->attach($permission);
                }
            }
        }
    }
}
