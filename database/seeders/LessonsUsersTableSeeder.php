<?php

namespace Database\Seeders;

use App\Models\LessonsUser;
use Illuminate\Database\Seeder;

class LessonsUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LessonsUser::factory(50)->create();
    }
}
