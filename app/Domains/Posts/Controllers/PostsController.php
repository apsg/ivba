<?php
namespace App\Domains\Posts\Controllers;

use App\Domains\Posts\Actions\DisplayedPostsAction;
use App\Domains\Posts\Middlewares\PostDisplayMiddleware;
use App\Domains\Posts\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(PostDisplayMiddleware::class)->only('show');
    }

    public function index()
    {
        (new DisplayedPostsAction())->execute(Auth::user());

        $posts = Post::published()
            ->select('posts.*')
            ->withDisplays(Auth::user())
            ->orderBy('published_at')
            ->paginate(15);

        return view('posts.index')->with(compact('posts'));
    }

    public function show(string $slug)
    {
        $post = Post::where('slug', $slug)->first();

        return view('posts.show')->with(compact('post'));
    }
}
