<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LessonUser;
use App\Models\CourseUser;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Document;
use App\Models\Tag;
use App\Models\User;

class LessonUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LessonUser::factory(100)->create();
    }
}
