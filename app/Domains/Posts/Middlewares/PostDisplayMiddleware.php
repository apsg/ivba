<?php
namespace App\Domains\Posts\Middlewares;

use App\Domains\Posts\Actions\PostDisplayAction;
use App\Domains\Posts\Models\Post;
use App\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostDisplayMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $post = $this->getPostBySlug($request);

        /** @var User $user */
        $user = Auth::user();

        if ($post !== null && $user !== null) {
            (new PostDisplayAction())->execute($user, $post);
        }

        return $next($request);
    }

    protected function getPostBySlug(Request $request): ?Post
    {
        $slug = $request->route('slug');

        return Post::where('slug', $slug)->first();
    }
}
