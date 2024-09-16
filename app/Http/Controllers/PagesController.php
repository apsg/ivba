<?php
namespace App\Http\Controllers;

use App\Course;
use App\Domains\Courses\Models\Group;
use App\FullAccessOption;
use App\Lesson;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use TomLingham\Searchy\Facades\Searchy;

class PagesController extends Controller
{
    /**
     * Strona główna.
     * @return [type] [description]
     */
    public function home()
    {
        $courses = Cache::remember(
            'courses_front',
            60,
            function () {
                return Course::take(10)->get();
            });

        $lessons = Cache::remember(
            'lessons_front',
            1,
            function () {
                return Lesson::inRandomOrder()->take(4)->get();
            });

        $blog_items = [];

        $access_options = FullAccessOption::orderBy('price')->get();

        $is_front = true;

        $groups = Group::orderBy('order')->get();

        return view('welcome')
            ->with(compact('courses', 'lessons', 'blog_items', 'is_front', 'access_options', 'groups'));
    }

    public function continue(Request $request)
    {
        /** @var Order $order */
        $order = Order::find($request->order);

        if ($order !== null && $order->isQuickSales()) {
            $redirectUrl = $order->quick_sales->first()->redirect_url;

            if (!empty($redirectUrl)) {
                return redirect($redirectUrl);
            }
        }

        return view('continue')->with(compact('order'));
    }

    public function buyAccess()
    {
        if (setting('is.disable_buy')) {
            return view('buy_disabled');
        }

        return view('buy_access');
    }

    /**
     * Obsługa strony z wynikami wyszukiwania.
     * @param Request $request [description]
     * @return [type]           [description]
     */
    public function search(Request $request)
    {
        $s = request('search');

        $courses = Searchy::search('courses')
            ->fields('title', 'description')
            ->query($s)
            ->getQuery()
            ->having('relevance', '>', 20)
            ->get()->toArray();

        $courses = Course::hydrate($courses);

        $lessons = Searchy::search('lessons')
            ->fields('title', 'description')
            ->query($s)
            ->getQuery()
            ->having('relevance', '>', 20)
            ->get()->toArray();

        $lessons = Lesson::hydrate($lessons);

        return view('search')->with(compact('courses', 'lessons', 's'));
    }
}
