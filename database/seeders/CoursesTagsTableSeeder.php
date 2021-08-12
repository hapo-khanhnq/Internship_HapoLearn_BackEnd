<?php

namespace Database\Seeders;

use App\Models\CoursesTag;
use Illuminate\Database\Seeder;

class CoursesTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CoursesTag::factory(50)->create();
    }
}
