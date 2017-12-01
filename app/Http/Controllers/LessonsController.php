<?php

namespace App\Http\Controllers;

use App\Lesson;
use Illuminate\Http\Request;

class LessonsController extends Controller
{
    
	/**
	 * Pokaż widok pojedynczej lekcji
	 * @param  Lesson $lesson [description]
	 * @return [type]         [description]
	 */
	public function show(Lesson $lesson){
		return view('pages.lesson')->with(compact('lesson'));
	}

}
