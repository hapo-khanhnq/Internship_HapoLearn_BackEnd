<?php

namespace Database\Factories;

use App\Models\CoursesTag;
use Illuminate\Database\Eloquent\Factories\Factory;

class CoursesTagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CoursesTag::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'course_id' => rand(10, 30),
            'tag_id' => rand(10, 30)
        ];
    }
}
