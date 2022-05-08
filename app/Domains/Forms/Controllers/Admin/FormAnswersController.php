<?php
namespace App\Domains\Forms\Controllers\Admin;

use App\Domains\Forms\Models\Form;
use App\Domains\Forms\Models\FormAnswer;
use App\Domains\Forms\Requests\Forms\AnswerCommentRequest;
use App\Domains\Forms\Transformers\FormAnswerTransformer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Fractalistic\ArraySerializer;

class FormAnswersController extends Controller
{
    public function index(Form $form)
    {
        return fractal(
            $form->answers()->with('user', 'commenter')->orderBy('id', 'desc')->get(),
            new FormAnswerTransformer(),
            new ArraySerializer()
        );
    }

    public function comment(FormAnswer $answer, AnswerCommentRequest $request)
    {
        $answer->update([
            'comment'      => $request->input('comment'),
            'commenter_id' => Auth::id(),
            'commented_at' => now(),
        ]);

        return response()->json('ok', 200);
    }
}
