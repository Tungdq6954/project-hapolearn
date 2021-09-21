<?php

namespace Database\Factories;

use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lesson::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $courses = Course::get();
        $coursesIdArray = [];

        foreach ($courses as $course) {
            array_push($coursesIdArray, $course->id);
        }

        return [
            'title' => $this->faker->text(),
            'description' => $this->faker->text(),
            'requirement' => $this->faker->realText(),
            'content' => $this->faker->realText(),
            'learn_time' => rand(1, 4),
            'course_id' => $coursesIdArray[rand(0, count($coursesIdArray) - 1)],
        ];
    }
}
