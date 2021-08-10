<?php

namespace Database\Factories;

use App\Models\CoursesUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class CoursesUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CoursesUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'course_id' => rand(10, 30),
            'user_id' => rand(10, 30)
        ];
    }
}
