<?php
namespace App\Domains\Logbooks\Controllers;

use App\Course;
use App\Domains\Logbooks\Models\Logbook;
use App\Http\Controllers\Controller;

class LogbookController extends Controller
{
    public function show(Course $course, Logbook $logbook)
    {
        return view('learn.logbook')->with(compact('course', 'logbook'));
    }
}
