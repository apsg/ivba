<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;

class AdminImagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Zwraca listę obrazów.
     * @return [type] [description]
     */
    public function index()
    {
        $images = Image::orderBy('created_at', 'desc')->paginate(10);

        if (request()->ajax()) {
            return \View::make('admin.partials.imageslist')
                ->with(compact('images'))
                ->render();
        }
    }

    /**
     * Zapisz nowy obraz - wyślij do wistii i zapisz w DB.
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {
        $path = $request->file('image')->store('public/images');
        $filename = basename($path);

        $url = url('storage/images/' . $filename);
        $url = str_replace('http://', '//', $url);

        $img = Image::create(compact('filename', 'url'));

        if (request()->ajax()) {
            return $img;
        } else {
            return back();
        }
    }
}
