<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PostStatuses;

class PostStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostStatuses::create([
            'name' => 'Draft',
            'sort_num' => '0'
        ]);

        PostStatuses::create([
            'name' => 'Published',
            'sort_num' => '1'
        ]);

        PostStatuses::create([
            'name' => 'Unpublished',
            'sort_num' => '2'
        ]);
    }
}
