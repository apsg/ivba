<?php
namespace App\Domains\Api\Controllers;

use App\Course;
use App\Domains\Api\Transformers\CoursesTransformer;
use App\Http\Controllers\Controller;

class CoursesController extends Controller
{
    public function index()
    {
        return fractal()
            ->collection(
                Course::orderBy('title')->select(['id', 'title'])->get(),
                new CoursesTransformer()
            );
    }
}
