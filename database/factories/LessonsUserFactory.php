<?php

namespace Database\Factories;

use App\Models\LessonsUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonsUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LessonsUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'lesson_id' => rand(10, 30),
            'used_id' => rand(10, 30),
            'learned' => rand(0, 1)
        ];
    }
}
