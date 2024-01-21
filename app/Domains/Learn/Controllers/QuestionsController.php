<?php
namespace App\Domains\Learn\Controllers;

use App\Domains\Learn\QuestionsService;
use App\Domains\Learn\Requests\AskQuestionRequest;
use App\Http\Controllers\Controller;
use App\Mail\FreshdeskSupportMail;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class QuestionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ask(AskQuestionRequest $request, QuestionsService $service)
    {
        if (empty(config('services.freshdesk.email'))) {
            return response();
        }

        /** @var User $user */
        $user = Auth::user();

        Mail::to(config('services.freshdesk.email'))
            ->send(new FreshdeskSupportMail(
                $user,
                $request->input('message'),
                $request->course(),
                $request->lesson(),
                $request->input('phone')
            ));

        $service->decrement($user);

        return response([], 200);
    }
}
