<?php

use App\Course;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_group', function (Blueprint $table) {
            $table->unsignedInteger('course_id');
            $table->foreign('course_id')
                ->references('id')
                ->on('courses')
                ->onDelete('cascade');
            $table->unsignedInteger('group_id');
            $table->foreign('group_id')
                ->references('id')
                ->on('groups')
                ->onDelete('cascade');
            $table->unsignedSmallInteger('order')->default(0);
        });

        /** @var Collection<Course> $courses */
        $courses = Course::whereNotNull('group_id')->get();

        /** @var Course $course */
        foreach ($courses as $course) {
            DB::table('course_group')
                ->insert([
                             'course_id' => $course->id,
                             'group_id'  => $course->group_id,
                             'order'     => $course->position
                         ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_group');
    }
}
