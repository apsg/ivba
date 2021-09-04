<?php
namespace App\Domains\Logbooks;

use App\Course;
use App\Domains\Logbooks\Models\Logbook;
use App\Domains\Logbooks\Models\LogbookEntry;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class LogbookRepository
{
    public function syncCourses(Logbook $logbook, array $courseIds = [])
    {
        $logbook->courses()->sync($courseIds);
    }

    public function addEntry(User $user, Logbook $logbook, Course $course, array $data) : LogbookEntry
    {
        return LogbookEntry::create([
            'user_id'     => $user->id,
            'logbook_id'  => $logbook->id,
            'course_id'   => $course->id,
            'title'       => Arr::get($data, 'title'),
            'description' => Arr::get($data, 'description'),
            'image'       => Arr::get($data, 'image'),
        ]);
    }

    public function getEntries(User $user, Course $course, Logbook $logbook) : Collection
    {
        return LogbookEntry::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->where('logbook_id', $logbook->id)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
