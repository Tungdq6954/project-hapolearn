<?php

namespace Database\Factories;

use App\Models\DocumentUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DocumentUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'document_id' => rand(1, 200),
            // 'user_id' => rand(1, 200),
        ];
    }
}
