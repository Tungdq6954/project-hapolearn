<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $courseID = rand(0, 200);
        if ($courseID == 0) {
            $lessonID = rand(1, 200);
            $courseID = null;
        } else {
            $lessonID = null;
        }
        return [
            'content' => $this->faker->text(),
            'rate' => rand(1, 5),
            'user_id' => rand(1, 200),
            'course_id' => $courseID,
            'lesson_id' => $lessonID
        ];
    }
}
