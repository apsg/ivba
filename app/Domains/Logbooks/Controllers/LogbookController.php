<?php
namespace App\Domains\Logbooks\Controllers;

use App\Course;
use App\Domains\Logbooks\LogbookRepository;
use App\Domains\Logbooks\Models\Logbook;
use App\Domains\Logbooks\Requests\StoreLogbookEntryRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogbookController extends Controller
{
    public function show(Course $course, Logbook $logbook, LogbookRepository $repository)
    {
        $entries = $repository->getEntries(Auth::user(), $course, $logbook);

        return view('learn.logbook')
            ->with(compact('course', 'logbook', 'entries'));
    }

    public function storeEntry(
        Course $course,
        Logbook $logbook,
        StoreLogbookEntryRequest $request,
        LogbookRepository $repository
    ) {
        $repository->addEntry(
            $request->user(),
            $logbook,
            $course,
            $request->data()
        );

        if ($request->wantsJson()) {
            return $this->statusOk();
        }

        return back();
    }
}
