<?php
namespace App\Domains\Posts\Controllers;

use App\Domains\Posts\Actions\DisplayedPostsAction;
use App\Domains\Posts\Actions\PostDisplayAction;
use App\Domains\Posts\PostsService;
use App\Domains\Posts\Transformers\WordpressPostTransformer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Fractalistic\ArraySerializer;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(PostsService $postsService)
    {
        (new DisplayedPostsAction())->execute(Auth::user());

        $posts = $postsService->fetch();
        $postDisplays = $postsService->getDisplaysForUser(Auth::user());


        return view('posts.index')->with([
            'posts' => fractal($posts, new WordpressPostTransformer($postDisplays))
                ->serializeWith(ArraySerializer::class)
                ->toArray(),
        ]);
    }

    public function show(string $slug, PostsService $postsService)
    {
        $post = $postsService->getPostBySlug($slug);

        (new PostDisplayAction())->execute(Auth::user(), $post);

        return view('posts.show')->with(compact('post'));
    }
}
