<?php
namespace App\Console\Commands;

use App\Access;
use App\Course;
use Illuminate\Console\Command;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;

class FixSpecialCoursesVisibilityCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ivba:fix_special_visibility';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix visibility for special courses';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /** @var Collection|Course[] $specialCourses */
        $specialCourses = Course::where('is_special_access', true)
            ->select('id')
            ->get()
            ->pluck('id')
            ->toArray();

        $accesses = Access::where('accessable_type', Course::class)
            ->whereIn('accessable_id', $specialCourses)
            ->get();

        $this->info('Accesses to process: ' . $accesses->count());

        /** @var Access $access */
        foreach ($accesses as $access) {
            try {
                $access->user->courses()->attach($access->accessable_id);
            } catch (QueryException $exception) {
                // do nothing, already exists
            }
        }

        $this->info('Finished');

        return null;
    }
}
