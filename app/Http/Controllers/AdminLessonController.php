<?php

namespace App\Http\Controllers;

use App\Lesson;
use Illuminate\Http\Request;
use App\Http\Requests\LessonRequest;

class AdminLessonController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    	$this->middleware('admin');
    }

    /**
     * Listuj wszystkie kursy
     * @return [type] [description]
     */
    public function index(){
    	$lessons = Lesson::all();
    	return view('admin.lessons')->with(compact('lessons'));
    }

    /**
     * Formularz dodawania nowego kursu
     * @return [type] [description]
     */
    public function create(){
        return view('admin.lessons.new');
    }

    /**
     * Dodaj nową lekcję do bazy danych
     * @param  LessonRequest $request [description]
     * @return [type]                 [description]
     */
    public function store(LessonRequest $request){
    	$fields = $request->all();

    	if(empty($fields['slug'])){
    		$fields['slug'] = str_slug($fields['title']);
    	}

    	$fields['user_id'] = auth()->user()->id;

    	$lesson = Lesson::create($fields);

    	return redirect('/admin/lesson/'.$lesson->slug)->with('message', 'Lekcja dodana!');;
    }

    /**
     * Pokaż stronę edycji lekcji
     * @param  Lesson $lesson [description]
     * @return [type]         [description]
     */
    public function show(Lesson $lesson){
    	return view('admin.lessons.lesson')->with(compact('lesson'));
    }

    /**
     * Zaktualizuj dane lekcji
     * @param  Lesson        $lesson  [description]
     * @param  LessonRequest $request [description]
     * @return [type]                 [description]
     */
    public function update(Lesson $lesson, LessonRequest $request){

        $fields = $request->all();

        if(empty($fields['slug'])){
            $fields['slug'] = str_slug($fields['title']);
        }
        
        $lesson->update($fields);

        return back()->with('message', 'Lekcja zapisana!');;
    }

    /**
     * Zaktualizuj kolejność elementów przypisanych do lekcji
     * @param  Lesson  $lesson  [description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function updateItemsOrder(Lesson $lesson, Request $request){
       
        foreach ($request->order as $item) {
            \DB::table('items')
                ->where('lesson_id', $lesson->id)
                ->where('items_id', $item['id'])
                ->where('items_type', $item['class'])
                ->update(['position' => $item['order'] ]);
        }

        return ['ok'];
    }

}
