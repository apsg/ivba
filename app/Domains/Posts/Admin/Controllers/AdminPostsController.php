<?php
namespace App\Domains\Posts\Admin\Controllers;

use App\Domains\Posts\Models\Post;
use App\Http\Controllers\Controller;

class AdminPostsController extends Controller
{
    public function index()
    {
        return view('admin.posts.index');
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store()
    {

    }

    public function show(Post $post)
    {

    }
}
