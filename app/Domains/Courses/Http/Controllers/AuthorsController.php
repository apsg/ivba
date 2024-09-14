<?php
namespace App\Domains\Courses\Http\Controllers;

use App\Domains\Courses\Http\Requests\AuthorRequest;
use App\Domains\Courses\Models\Author;
use App\Domains\Courses\Repositories\AuthorsRepository;

class AuthorsController
{
    public function index()
    {
        $authors = Author::all();

        return view('admin.authors.index')->with(compact('authors'));
    }

    public function store(AuthorRequest $request, AuthorsRepository $authorsRepository)
    {
        $authorsRepository->create(
            $request->input('name'),
            $request->input('image'),
            $request->input('is_internal', false),
            $request->input('description'),
            $request->input('bio')
        );

        flash('Zapisano');


        return back();
    }

    public function update(Author $author, AuthorRequest $request)
    {
        $author->update($request->validated());

        flash('Zapisano');

        return back();
    }

    public function destroy(Author $author)
    {
        $author->delete();

        return back();
    }
}
