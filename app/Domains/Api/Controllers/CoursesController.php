<?php
namespace App\Domains\Api\Controllers;

use App\Course;
use App\Domains\Api\Transformers\CopyCourseTransformer;
use App\Domains\Api\Transformers\CoursesTransformer;
use App\Http\Controllers\Controller;
use League\Fractal\Serializer\ArraySerializer;

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

    public function show(int $courseId)
    {
        $course = Course::findOrFail($courseId);

        return fractal()
            ->item($course, new CopyCourseTransformer())
            ->serializeWith(new ArraySerializer());
    }
}
