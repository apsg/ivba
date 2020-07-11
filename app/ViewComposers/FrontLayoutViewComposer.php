<?php
namespace App\ViewComposers;

use App\MenuItem;
use App\Services\LastLessonService;
use Auth;
use Illuminate\View\View;

class FrontLayoutViewComposer
{
    public function compose(View $view)
    {
        $menu = MenuItem::getMenu(1);

        $lastLesson = null;
        if (session()->get('check_last_lesson')) {
            $lastLesson = app(LastLessonService::class)
                ->get(Auth::user());
        }

        $view->with(compact('menu', 'lastLesson'));
    }
}
