<?php

namespace App\Http\Controllers;

use App\Newsletter;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NewslettersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $newsletters = Newsletter::all();

        return view('admin.newsletters')->with(compact('newsletters'));
    }

    public function create()
    {
        return view('admin.newsletters.new');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body'  => 'required',
            'delay' => 'required|numeric|min:0',
            'unit'  => 'required|numeric',
        ]);

        $send_at = Carbon::now();
        if ($request->delay > 0) {
            switch ($request->unit) {
                case 1:
                {
                    $send_at = $send_at->addMinutes($request->delay);
                    break;
                }
                case 2:
                {
                    $send_at = $send_at->addHours($request->delay);
                    break;
                }
                case 3:
                {
                    $send_at = $send_at->addDays($request->delay);
                    break;
                }
                case 4:
                {
                    $send_at = $send_at->addWeeks($request->delay);
                    break;
                }
            }
        }

        $newsletter = Newsletter::create([
            'title'   => $request->title,
            'slug'    => $request->slug ?? str_slug($request->title),
            'body'    => $request->body,
            'send_at' => $send_at,
        ]);

        $newsletter->scheduleEmails();

        flash('Utworzono pomyślnie');

        return redirect('/admin/newsletters/' . $newsletter->id);
    }

    public function edit(Newsletter $newsletter)
    {
        return view('admin.newsletters.edit')->with(compact('newsletter'));
    }

    public function patch(Newsletter $newsletter, Request $request)
    {

        $this->validate($request, [
            'title'      => 'required',
            'body'       => 'required',
            'slug'       => 'required',
            'attachment' => 'file',
            'send_at'    => 'required|date',
        ]);

        $attachment = $newsletter->attachment;

        if ($request->attachment) {

            $attachment = $request->file('attachment')
                ->storeAs('attachments', $request->attachment->getClientOriginalName());
        }

        $newsletter->update([
            'title'      => $request->title,
            'body'       => $request->body,
            'slug'       => $request->slug,
            'send_at'    => $request->send_at,
            'attachment' => $attachment,

        ]);

        flash('Zapisano pomyślnie');

        return back();
    }
}
