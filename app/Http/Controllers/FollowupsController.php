<?php

namespace App\Http\Controllers;

use App\FollowupContent;
use Illuminate\Http\Request;

class FollowupsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }


    /**
     * Pokaż spis followupów
     * @return [type] [description]
     */
    public function index()
    {
        $followups = FollowupContent::all()
            ->groupBy('event');

        return view('admin.followups.followups')->with(compact('followups'));
    }

    /**
     * Pokaż widok tworzenia nowego followupa
     * @return [type] [description]
     */
    public function create()
    {
        $selected = request()->input('selected');

        return view('admin.followups.new')->with(compact('selected'));
    }

    /**
     * Zapisz followup w bazie
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'      => 'required',
            'body'       => 'required',
            'slug'       => 'required|unique:followup_contents',
            'delay'      => 'required|numeric|min:0',
            'unit'       => 'required|numeric',
            'event'      => 'required',
            'attachment' => 'file',
        ]);

        $interval = "P0D";

        if ($request->delay > 0) {
            if ($request->unit < 3) {
                $interval = "PT" . $request->delay . ($request->unit == 1 ? "M" : "H");
            } else {
                $interval = "P" . $request->delay . ($request->unit == 3 ? "H" : "W");
            }
        }

        $attachment = null;

        if ($request->attachment) {
            $attachment = $request->attachment
                ->storeAs('attachments', $request->attachment->getClientOriginalName());
        }

        $followup = FollowupContent::create([
            'title'      => $request->title,
            'body'       => $request->body,
            'slug'       => $request->slug,
            'delay'      => $interval,
            'event'      => $request->event,
            'attachment' => $attachment,
        ]);


        return redirect('/admin/followups/' . $followup->id);
    }

    /**
     * Pokaż okno edycji
     * @param  FollowupContent $followup [description]
     * @return [type]                    [description]
     */
    public function edit(FollowupContent $followup)
    {
        return view('admin.followups.edit')->with(compact('followup'));
    }


    /**
     * Zaktualizuj Treść Followupu
     * @param  FollowupContent $followup [description]
     * @param  Request         $request [description]
     * @return [type]                    [description]
     */
    public function patch(FollowupContent $followup, Request $request)
    {

        $this->validate($request, [
            'title'      => 'required',
            'body'       => 'required',
            'slug'       => 'required|unique:followup_contents,id,' . $followup->id,
            'delay'      => 'required',
            'attachment' => 'file',
        ]);

        $attachment = $followup->attachment;

        if ($request->attachment) {
            $attachment = $request->attachment
                ->storeAs('attachments', $request->attachment->getClientOriginalName());
        }

        $followup->update([
            'title'      => $request->title,
            'body'       => $request->body,
            'slug'       => $request->slug,
            'delay'      => $request->delay,
            'attachment' => $attachment,
        ]);

        flash('Zapisano poprawnie');

        return back();
    }

    /**
     * Wyślij testową wiadomość do zalogowanego użytkownika
     * @param  FollowupContent $followup [description]
     * @return [type]                    [description]
     */
    public function sendTest(FollowupContent $followup)
    {

        \Auth::user()->emails()->create([
            'from'             => config('mail.from.address'),
            'title'            => $followup->title,
            'body'             => $followup->body,
            'send_at'          => \Carbon\Carbon::now(),
            'type'             => 2,
            'attachment'       => $followup->attachment,
            'unsubscribe_code' => uniqid(),
        ]);

        flash('Przygotowano do wysłania');

        return back();
    }

    /**
     * Usuń element
     * @param  FollowupContent $followup [description]
     * @return [type]                    [description]
     */
    public function destroy(FollowupContent $followup)
    {
        $followup->delete();

        flash('Usunięto');

        return back();
    }
}
