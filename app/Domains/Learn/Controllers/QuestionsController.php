<?php
namespace App\Domains\Learn\Controllers;

use App\Domains\Learn\Requests\AskQuestionRequest;
use App\Http\Controllers\Controller;
use App\Mail\FreshdeskSupportMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class QuestionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ask(AskQuestionRequest $request)
    {
        if (empty(config('services.freshdesk.email'))) {
            return response();
        }

        Mail::to(config('services.freshdesk.email'))
            ->send(new FreshdeskSupportMail(
                Auth::user(),
                $request->input('message'),
                $request->course(),
                $request->lesson()
            ));

        return response([], 200);
    }
}
