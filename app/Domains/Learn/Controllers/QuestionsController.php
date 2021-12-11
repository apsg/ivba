<?php
namespace App\Domains\Learn\Controllers;

use App\Domains\Learn\Requests\AskQuestionRequest;
use App\Http\Controllers\Controller;

class QuestionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ask(AskQuestionRequest $request)
    {

    }
}
