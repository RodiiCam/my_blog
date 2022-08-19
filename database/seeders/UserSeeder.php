<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::where('name', 'editor')->first();

        User::factory()
            ->count(20)
            ->has(Post::factory()->count(3))
            ->hasAttached($roles)
            ->create();
    }
}
