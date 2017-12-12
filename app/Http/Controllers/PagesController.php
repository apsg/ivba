<?php

namespace App\Http\Controllers;

use Searchy;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    
    /**
     * Strona główna
     * @return [type] [description]
     */
	public function home(){

		$courses = \Cache::remember(
			'courses_front',
			60, 
			function(){
				return \App\Course::take(10)->get();
		});

		$lessons = \Cache::remember(
			'lessons_front',
			1,
			function(){
				return \App\Lesson::inRandomOrder()->take(10)->get();
			});


		$blog_items = [];

		$access_options = \App\FullAccessOption::orderBy('price')->get();

		$is_front = true;

		return view('welcome')
			->with(compact('courses', 'lessons', 'blog_items', 'is_front', 'access_options'));
	}

	/**
	 * Ekran powrotu z payu
	 * @return [type] [description]
	 */
	public function continue(Request $request){

		$order = \App\Order::find( $request->order );
		return view('continue')->with(compact('order'));
	}

	/**
	 * Strona z zakupem pełnego dostępu
	 * @return [type] [description]
	 */
	public function buyAccess(){
		return view('buy_access');
	}

	/**
	 * Obsługa strony z wynikami wyszukiwania
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function search(Request $request){
		$s = request('search');

		$courses = Searchy::search('courses')
			->fields('title', 'description')
			->query($s)
			->getQuery()
			->having('relevance', '>', 20)
			->get()->toArray();

		$courses = \App\Course::hydrate( $courses );

		$lessons = Searchy::search('lessons')
			->fields('title', 'description')
			->query($s)
			->getQuery()
			->having('relevance', '>', 20)
			->get()->toArray();

		$lessons = \App\Lesson::hydrate( $lessons );

		return view('search')->with(compact('courses', 'lessons', 's'));

	}

}
