<?php
namespace App\Http\Controllers;

use App\Http\Requests\LessonRequest;
use App\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminLessonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $lessons = Lesson::all();

        return view('admin.lessons')->with(compact('lessons'));
    }

    public function create()
    {
        return view('admin.lessons.new');
    }

    public function store(LessonRequest $request)
    {
        $fields = $request->all();

        if (empty($fields['slug'])) {
            $fields['slug'] = str_slug($fields['title']);
        }

        $fields['user_id'] = auth()->user()->id;

        $lesson = Lesson::create($fields);

        return redirect('/admin/lesson/' . $lesson->slug)->with('message', 'Lekcja dodana!');
    }

    public function show(Lesson $lesson)
    {
        return view('admin.lessons.lesson')->with(compact('lesson'));
    }

    public function update(Lesson $lesson, LessonRequest $request)
    {
        $fields = $request->all();

        if (empty($fields['slug'])) {
            $fields['slug'] = str_slug($fields['title']);
        }

        $lesson->update($fields);

        if ($lesson->video !== null && !empty($request->input('cloudflare_uid'))) {
            $lesson->video->update([
                'cloudflare_uid' => $request->input('cloudflare_uid'),
            ]);
        }

        return back()->with('message', 'Lekcja zapisana!');
    }

    /**
     * Zaktualizuj kolejność elementów przypisanych do lekcji.
     */
    public function updateItemsOrder(Lesson $lesson, Request $request)
    {
        foreach ($request->order as $item) {
            DB::table('items')
                ->where('lesson_id', $lesson->id)
                ->where('items_id', $item['id'])
                ->where('items_type', $item['class'])
                ->update(['position' => $item['order']]);
        }

        return ['ok'];
    }
}
