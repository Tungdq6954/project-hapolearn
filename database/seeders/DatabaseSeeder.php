<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CourseTableSeeder::class);
        $this->call(CourseTagTableSeeder::class);
        $this->call(CourseUserTableSeeder::class);
        $this->call(LessonTableSeeder::class);
        $this->call(LessonUserTableSeeder::class);
        $this->call(ReviewTableSeeder::class);
        $this->call(TagTableSeeder::class);
        $this->call(DocumentTableSeeder::class);
        $this->call(DocumentUserTableSeeder::class);
    }
}
