<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reply;

class ReplyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reply::factory(2000)->create();
    }
}
