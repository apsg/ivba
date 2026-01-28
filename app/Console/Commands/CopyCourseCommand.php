<?php
namespace App\Console\Commands;

use App\Course;
use App\Domains\Microservice\Connector;
use App\Image;
use App\Item;
use App\ItemFile;
use App\Lesson;
use App\Video;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CopyCourseCommand extends Command
{
    protected $signature = 'course:copy';

    public function handle()
    {
        $providers = [
            'inauka',
            'techniczni',
            'projekt30',
            'is',
        ];

        $provider = $this->choice('Wybierz serwis źródłowy', $providers);
        $curseId = $this->ask('Podaj ID kursu');
        $userId = $this->ask('Do jakiego użytkownika przypiąć kursy?');

        $connector = new Connector();

        $data = $connector->course($provider, $curseId);
        $data['user_id'] = $userId;

        DB::transaction(function () use ($data) {

            $course = $this->createCourse($data);

            if (!empty(Arr::get($data, 'image'))) {
                $image = $this->createImage(Arr::get($data, 'image'));
            }

            if (!empty(Arr::get($data, 'video'))) {
                $video = $this->createVideo(Arr::get($data, 'video'));
            }

            $course->update(array_filter([
                'image_id' => !empty($image) ? $image->id : null,
                'video_id' => !empty($video) ? $video->id : null,
            ]));

            $this->createLessons($course, Arr::get($data, 'lessons.data', []));
        });
    }

    protected function createImage(array $imageData): ?Image
    {
        if ($image = Image::where('filename', Arr::get($imageData, 'filename'))->first()) {
            return $image;
        }

        $imgFile = Storage::disk('public')->put(
            'images/' . Arr::get($imageData, 'filename'),
            file_get_contents(Arr::get($imageData, 'url')));

        return Image::create([
            'filename' => Arr::get($imageData, 'filename'),
            'url'      => url('/storage/images/' . Arr::get($imageData, 'filename')),
        ]);
    }

    protected function createCourse($data): Course
    {
        return Course::create(Arr::except($data, [
            'id',
            'lessons',
            'created_at',
            'updated_at',
            'image_id',
            'video_id',
        ]));
    }

    protected function createLessons(Course $course, array $lessons): void
    {
        foreach ($lessons as $lesson) {
            $this->attachLesson($course, $lesson);
        }
    }

    protected function attachLesson(Course $course, array $lessonData): void
    {
        $image = $this->createImage(Arr::get($lessonData, 'image'));
        $video = $this->createVideo(Arr::get($lessonData, 'video'));

        $lesson = Lesson::create([
                'user_id'  => $course->user_id,
                'image_id' => $image->id ?? null,
                'video_id' => $video->id ?? null,
            ] + Arr::only($lessonData, [
                'slug',
                'title',
                'description',
                'introduction',
                'price',
                'duration',
                'seo_title',
                'seo_description',
                'difficulty',
            ]));

        $course->lessons()->attach($lesson->id, [
            'position' => Arr::get($lessonData, 'pivot.position', '0'),
            'delay'    => Arr::get($lessonData, 'pivot.delay', null),
        ]);

        foreach (Arr::get($lessonData, 'items.data', []) as $itemData) {
            $item = $this->createItem($itemData);
            $lesson->files()->attach($item->id, ['position' => Arr::get($itemData, 'position', 0)]);
        }
    }

    protected function createVideo(array $data): ?Video
    {
        return Video::create(Arr::only(
            $data,
            ['filename', 'hash', 'url', 'thumb', 'cloudflare_uid']
        ));
    }

    public function createItem(array $data): Item
    {
        return ItemFile::create(Arr::except($data, [
            'id',
            'created_at',
            'updated_at',
            'position',
        ]));
    }
}
