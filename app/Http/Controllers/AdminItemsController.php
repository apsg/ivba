<?php

namespace App\Http\Controllers;

use App\ItemFile;
use App\ItemImage;
use App\ItemMovie;
use App\ItemText;
use App\Lesson;
use Illuminate\Http\Request;

class AdminItemsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Dodaj nowy element do lekcji.
     * @param Lesson  $lesson  [description]
     * @param Request $request [description]
     */
    public function add(Lesson $lesson, Request $request)
    {

        // Wstępna walidacja - pola wspólne
        $this->validate($request, [
                'title' => 'required',
                'type' => 'required|in:image,text,file,video',
            ]);

        // Dodawanie nowego obrazu
        if ($request->type == 'image') {
            $this->validate($request, [
                'image_id' => 'required|numeric|exists:images,id',
            ]);

            $image = ItemImage::create($request->only([
                    'title',
                    'image_id',
                ]));

            $lesson->images()->attach($image, ['position' => $lesson->nextItemPosition()]);

            return back()->with('message', 'Dodano pomyślnie');
        }

        // Dodawanie nowego obiektu tekstowego
        if ($request->type == 'text') {
            $this->validate($request, [
                'text' => 'required',
                ]);

            $text = ItemText::create($request->only([
                'title',
                'text',
                ]));

            $lesson->texts()->attach($text, ['position' => $lesson->nextItemPosition()]);

            return back()->with('message', 'Dodano pomyślnie');
        }

        //  Dodawanie nowego pliku
        if ($request->type == 'file') {
            $this->validate($request, [
                'file' => 'required|file',
                'host' => 'required|in:1,2',

                ]);

            $size = $request->file('file')->getClientSize();
            $type = $request->file('file')->extension();
            $name = $request->file('file')->getClientOriginalName();
            $mime = $request->file('file')->getMimeType();

            // Wistia
            if ($request->host == 1) {
                $tmpPath = $request->file->store('tmp');
                $w = new \App\Helpers\Wistia;
                $res = $w->uploadFile(storage_path('app/' . $tmpPath));

                $file = ItemFile::create([
                    'host' => 1,
                    'size' => $size,
                    'type' => $type,
                    'title' => $request->title,
                    'hash' => $res['hash'],
                    'path' => $res['url'],
                    'name' => $name,
                    'mime' => $mime,
                    ]);
                $lesson->files()->attach($file, ['position' => $lesson->nextItemPosition()]);

                \File::cleanDirectory(storage_path('app/tmp'));

                return back()->with('message', 'Dodano pomyślnie');
            }

            // Lokalny storage
            if ($request->host == 2) {
                $path = $request->file->store('files');

                $file = ItemFile::create([
                    'host' => 2,
                    'size' => $size,
                    'type' => $type,
                    'title' => $request->title,
                    'path' => 'app/' . $path,
                    'name' => $name,
                    'mime' => $mime,
                    ]);
                $lesson->files()->attach($file, ['position' => $lesson->nextItemPosition()]);

                return back()->with('message', 'Dodano pomyślnie');
            }
        }

        // Dodawanie nowego obrazu
        if ($request->type == 'video') {
            $this->validate($request, [
                'video_id' => 'required|numeric|exists:videos,id',
            ]);

            $video = ItemMovie::create($request->only([
                    'title',
                    'video_id',
                ]));

            $lesson->videos()->attach($video, ['position' => $lesson->nextItemPosition()]);

            return back()->with('message', 'Dodano pomyślnie');
        }
    }

    /**
     * Usuń plik.
     * @param  ItemFile $item [description]
     * @return [type]         [description]
     */
    public function deleteFile(ItemFile $item)
    {
        $item->delete();

        return back()->with('message', 'Element usunięty');
    }

    /**
     * Usuń obraz.
     * @param  ItemFile $item [description]
     * @return [type]         [description]
     */
    public function deleteImage(ItemImage $item)
    {
        $item->delete();

        return back()->with('message', 'Element usunięty');
    }

    /**
     * Usuń film.
     * @param  ItemFile $item [description]
     * @return [type]         [description]
     */
    public function deleteMovie(ItemMovie $item)
    {
        $item->delete();

        return back()->with('message', 'Element usunięty');
    }

    /**
     * Usuń tekst.
     * @param  ItemFile $item [description]
     * @return [type]         [description]
     */
    public function deleteText(ItemText $item)
    {
        $item->delete();

        return back()->with('message', 'Element usunięty');
    }
}
