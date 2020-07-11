<?php

use Illuminate\Database\Seeder;

class LessonsSeeder extends Seeder
{
    public function run()
    {
        factory(\App\Lesson::class, 10)->create();
    }
}
