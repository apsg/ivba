<?php
namespace App\Domains\Posts\Controllers;

use App\Domains\Posts\Models\Post;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::published()
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        return view('posts.index')->with(compact('posts'));
    }

    public function show(string $slug)
    {
        $post = Post::where('slug', $slug)->first();

        return view('posts.show')->with(compact('post'));
    }
}
