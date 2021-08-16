<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CourseTag;

class CourseTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CourseTag::factory(100)->create();
    }
}
