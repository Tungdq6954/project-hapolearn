<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CourseTag;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Document;
use App\Models\Tag;

class CourseTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = Tag::get();

        Course::all()->each(function ($course) use ($tags) {
            $course->tags()->attach(
                $tags->random(10)->pluck('id')->toArray()
            );
        });
    }
}
