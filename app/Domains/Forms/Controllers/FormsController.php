<?php
namespace App\Domains\Forms\Controllers;

use App\Course;
use App\Domains\Forms\Models\Form;
use App\Domains\Forms\Repositories\FormAnswersRepository;
use App\Domains\Forms\Requests\StoreFormAnswerRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FormsController extends Controller
{
    public function show(Course $course, Form $form, FormAnswersRepository $repository)
    {
        return view('learn.forms')->with([
            'course'  => $course,
            'form'    => $form,
            'answers' => $repository->forFormAndUser($form, Auth::user()),
        ]);
    }

    public function store(
        Course $course,
        Form $form,
        StoreFormAnswerRequest $request,
        FormAnswersRepository $repository
    ) {
        $repository->store($form, Auth::user(), $request->validated());

        flash('Odpowiedź zapisana');

        return back();
    }
}
