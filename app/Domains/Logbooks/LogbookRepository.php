<?php
namespace App\Domains\Logbooks;

use App\Domains\Logbooks\Models\Logbook;

class LogbookRepository
{
    public function syncCourses(Logbook $logbook, array $courseIds = [])
    {
        $logbook->courses()->sync($courseIds);
    }
}
