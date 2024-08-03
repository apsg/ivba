<?php
namespace App\Domains\Admin\Controllers;

use App\Course;
use App\Domains\Admin\Requests\StoreTagRequest;
use App\Domains\Courses\Models\Tag;
use App\Domains\Courses\Repositories\TagsRepository;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
    public function index()
    {
        return view('admin.tags.index')->with([
            'tags' => Tag::all(),
        ]);
    }

    public function store(StoreTagRequest $request, TagsRepository $repository)
    {
        $repository->create(
            $request->input('name'),
            $request->input('color'),
            !!$request->input('is_hidden', false)
        );

        flash('Zapisano');

        return back();
    }

    public function update(Tag $tag, StoreTagRequest $request)
    {
        $tag->update([
            'name'      => $request->input('name'),
            'color'     => $request->input('color'),
            'is_hidden' => !!$request->input('is_hidden', false),
        ]);

        flash('Zapisano');

        return back();
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();

        return back();
    }

    public function sync(Course $course)
    {
        $course->tags()->sync(request()->input('tags', []));

        return ['success' => true];
    }
}
