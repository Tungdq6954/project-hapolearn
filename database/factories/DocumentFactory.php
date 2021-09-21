<?php

namespace Database\Factories;

use App\Models\Document;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Document::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $index = rand(0, 2);
        $documentName = config('constants.documents')[$index];
        $documentExtension = substr($documentName, -3);
        $lessons = Lesson::get();
        $lessonsIdArray = [];

        foreach ($lessons as $lesson) {
            array_push($lessonsIdArray, $lesson->id);
        }

        return [
            'lesson_id' => $lessonsIdArray[rand(0, count($lessonsIdArray) - 1)],
            'name' => $documentName,
            'type' => $documentExtension,
            'logo_path' => 'img/' . $documentExtension,
            'file_path' => 'storage/' . $documentName,
        ];
    }
}
