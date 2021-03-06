<?php
namespace App\Domains\Logbooks\Controllers\Admin;

use App\Course;
use App\Domains\Admin\Requests\GetLogbookDataRequest;
use App\Domains\Logbooks\CourseActivityService;
use App\Domains\Logbooks\Models\Logbook;
use App\Domains\Logbooks\Requests\Admin\StoreLogbookRequest;
use App\Domains\Logbooks\Requests\Admin\UpdateLogbookRequest;
use App\Http\Controllers\Controller;

class LogbooksController extends Controller
{
    public function index()
    {
        $logbooks = Logbook::orderBy('title', 'asc')->get();

        return view('admin.logbooks.index')->with(compact('logbooks'));
    }

    public function create()
    {
        return view('admin.logbooks.create');
    }

    public function store(StoreLogbookRequest $request)
    {
        $logbook = Logbook::create($request->data());

        return redirect(route('admin.logbooks.edit', compact('logbook')));
    }

    public function edit(Logbook $logbook)
    {
        $courses = Course::all();

        return view('admin.logbooks.edit')->with(compact('logbook', 'courses'));
    }

    public function update(Logbook $logbook, UpdateLogbookRequest $request)
    {
        $logbook->update($request->data());
        $logbook->courses()->sync($request->input('course_id', []));

        flash('Zapisano');

        return back();
    }

    public function destroy(Logbook $logbook)
    {
        $logbook->delete();

        return redirect(route('admin.logbooks.index'));
    }

    public function getData(GetLogbookDataRequest $request, CourseActivityService $service)
    {
        return $service->get($request->student(), $request->course());
    }
}
