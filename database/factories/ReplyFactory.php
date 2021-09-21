<?php

namespace Database\Factories;

use App\Models\Reply;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReplyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reply::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = User::pluck('id')->toArray();
        $reviews = Review::pluck('id')->toArray();
        return [
            'content' => $this->faker->text(),
            'user_id' => rand(1, count($users)),
            'review_id' => rand(1, count($reviews)),
        ];
    }
}
