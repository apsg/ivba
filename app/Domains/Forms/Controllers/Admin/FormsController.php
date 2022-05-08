<?php
namespace App\Domains\Forms\Controllers\Admin;

use App\Course;
use App\Domains\Forms\Models\Form;
use App\Domains\Forms\Requests\Forms\StoreFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

class FormsController extends Controller
{
    public function index()
    {
        $forms = Form::all();

        return view('admin.forms.index')->with(compact('forms'));
    }

    public function create()
    {
        $courses = Course::all();
        $forms = config('forms');

        return view('admin.forms.create')->with(compact('courses', 'forms'));
    }

    public function store(StoreFormRequest $request)
    {
        try {
            Form::create($request->only('type', 'course_id'));
            flash('Dodano');
        } catch (QueryException $exception) {
            flash('Ten formularz już został dodany wcześniej do tego kursu')->error();
        }

        return redirect(route('admin.forms.index'));
    }

    public function view(Form $form)
    {
        return view('admin.forms.view')->with(compact('form'));
    }

    public function destroy(Form $form)
    {
        $form->delete();

        flash('Usunięto formularz');

        return back();
    }
}
