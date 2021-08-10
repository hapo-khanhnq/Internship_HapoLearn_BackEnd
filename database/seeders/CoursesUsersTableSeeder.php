<?php

namespace Database\Seeders;

use App\Models\CoursesUser;
use Illuminate\Database\Seeder;

class CoursesUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CoursesUser::factory(50)->create();
    }
}
