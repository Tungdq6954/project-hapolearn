<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CourseUser;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Document;
use App\Models\Tag;
use App\Models\User;

class CourseUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = Course::all();

        User::all()->each(function ($user) use ($courses) {
            $user->courses()->attach(
                $courses->random(5)->pluck('id')->toArray()
            );
        });
    }
}
