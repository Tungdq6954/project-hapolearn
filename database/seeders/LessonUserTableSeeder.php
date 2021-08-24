<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LessonUser;

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
