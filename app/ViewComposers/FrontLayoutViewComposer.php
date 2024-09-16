<?php
namespace App\ViewComposers;

use App\Domains\Posts\Models\Post;
use App\Domains\Posts\Transformers\PostTransformer;
use App\MenuItem;
use App\Services\LastLessonService;
use Auth;
use Carbon\Carbon;
use Illuminate\View\View;
use Spatie\Fractalistic\ArraySerializer;

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

        $posts = Post::where('published_at', '<', Carbon::now())->orderBy('published_at', 'desc')->get();
        $news = fractal()->collection($posts)
            ->transformWith(new PostTransformer())
            ->serializeWith(new ArraySerializer())
            ->toArray();

        $view->with(compact('menu', 'lastLesson', 'news'));
    }
}
