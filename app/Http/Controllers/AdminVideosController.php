<?php

namespace App\Http\Controllers;

use App\Helpers\VimeoHelper;
use App\Http\Requests\Admin\ImportVideoRequest;
use App\Video;
use Illuminate\Http\Request;
use Response;

class AdminVideosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Listuj bibliotekę filmów
     * @return [type] [description]
     */
    public function index()
    {
        $videos = Video::orderBy('created_at', 'desc')->paginate(10);

        if (request()->ajax()) {
            return \View::make('admin.partials.videoslist')
                ->with(compact('videos'))
                ->render();
        }
    }

    /**
     * Zapisz nowy film - wyślij do wistii i zapisz w DB
     * @param Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {

        $vid = Video::upload($request->video->path(), $request->video->getClientOriginalName(),
            $request->input('title', ''));

        return $vid;
    }

    public function import(ImportVideoRequest $request)
    {
        $data = VimeoHelper::import(
            '/videos/' . $request->hash(),
            $request->input('name'));

        Video::create($data);

        return Response::json([], 200);
    }
}
