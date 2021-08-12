<?php

namespace Database\Seeders;

use App\Models\CoursesUser;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(LessonsTableSeeder::class);
        $this->call(ReviewsTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(CoursesTagsTableSeeder::class);
        $this->call(CoursesUsersTableSeeder::class);
        $this->call(LessonsUsersTableSeeder::class);
    }
}
