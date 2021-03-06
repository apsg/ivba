<?php
namespace App\Http\Controllers;

use App\Helpers\PasswordReset;
use App\Http\Requests\UpdateUserInvoiceDataRequest;
use App\Payment;
use App\Services\LastLessonService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(LastLessonService $service)
    {
        $user = Auth::user();

        $payments = Payment::forUser($user)->orderBy('created_at', 'desc')->get();

        $lastLesson = $service->get($user);

        return view('account.account')->with(compact('user', 'payments', 'lastLesson'));
    }

    public function myCourses(LastLessonService $service)
    {
        $user = Auth::user();
        $lastLesson = $service->get($user);

        return view('account.mycourses')->with(compact('user', 'lastLesson'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $user->update($request->only('name'));

        return redirect('account');
    }

    /**
     * Zmień hasło.
     * @param Request $request [description]
     * @return [type]           [description]
     */
    public function changePassword(Request $request)
    {
        PasswordReset::send();

        Auth::logout();

        flash('Link do resetu hasła został pomyślnie wysłany. Nastąpiło automatyczne wylogowanie.');

        return redirect('/');
    }

    public function patch(UpdateUserInvoiceDataRequest $request)
    {
        Auth::user()
            ->update(
                $request->validated()
            );

        return back()->with(['status' => 'Zaktualizowano']);
    }
}
