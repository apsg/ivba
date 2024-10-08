<?php
namespace App\Domains\Posts\Admin\Controllers;

use App\Domains\Posts\Admin\Requests\StorePostRequest;
use App\Domains\Posts\Models\Post;
use App\Domains\Posts\Repositories\PostsRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminPostsController extends Controller
{
    public function index(): View
    {
        return view('admin.posts.index')->with([
            'posts' => Post::all(),
        ]);
    }

    public function create(): View
    {
        return view('admin.posts.create');
    }

    public function store(StorePostRequest $request, PostsRepository $repository): RedirectResponse
    {
        $post = $repository->create(
            $request->input('title'),
            $request->input('body'),
            $request->input('cta_url'),
            $request->input('image_id'),
        );

        return redirect(route('admin.posts.edit', $post));
    }

    public function edit(Post $post): View
    {
        return view('admin.posts.edit')->with(compact('post'));
    }

    public function update(Post $post, StorePostRequest $request): RedirectResponse
    {
        $post->update($request->only('title', 'body', 'image_id', 'cta_url'));

        return back();
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect(route('admin.posts.index'));
    }
}
