<?php

use App\Course;
use App\Lesson;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::setDefaultConnection('testing');

        $user = factory(User::class)->create([
            'isadmin' => true,
        ]);

        factory(Course::class, 10)->create([
            'user_id' => $user->id,
        ])->each(function (Course $c) use ($user) {
            for ($i = 0; $i < rand(1, 5); $i++) {
                $c->lessons()
                    ->save(factory(Lesson::class)
                        ->make([
                            'user_id' => $user->id,
                        ])
                    );
            }
        });


    }
}
