<?php

namespace App\Console\Commands;

use App\Point;
use App\Services\RankingService;
use App\User;
use DB;
use Illuminate\Console\Command;

class RecalculateRatingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ivba:rating {user?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /** @var RankingService */
    protected $service;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(RankingService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = User::find($this->argument('user'));

        if ($user !== null) {
            $this->info('Recalculate for user ' . $user->name);

            Point::where('user_id', $user->id)->delete();

            $finishedLessons = DB::table('lesson_user')
                ->whereNotNull('finished_at')
                ->where('user_id', $user->id)
                ->get();

            $passedQuizzes = DB::table('quiz_user')
                ->where('is_pass', true)
                ->where('user_id', $user->id)
                ->get();
        } else {
            $this->info('Recalculate for all users');

            Point::truncate();

            $finishedLessons = DB::table('lesson_user')
                ->whereNotNull('finished_at')
                ->get();

            $passedQuizzes = DB::table('quiz_user')
                ->where('is_pass', true)
                ->get();
        }

        foreach ($finishedLessons as $lesson) {
            $this->service->grantForLesson($lesson->user_id);
        }

        foreach ($passedQuizzes as $quiz) {
            $this->service->grantForQuiz($quiz->user_id);
        }

        $this->info('Finished');
    }
}
