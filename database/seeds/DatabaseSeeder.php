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
        $user = User::where('isadmin', true)->first();
        if ($user === null) {
            $user = factory(User::class)->create([
                'isadmin' => true,
            ]);
        }

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
