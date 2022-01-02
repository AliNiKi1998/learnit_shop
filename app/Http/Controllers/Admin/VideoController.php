<?php

namespace App\Http\Controllers\Admin;

use App\Video;
use App\Course;

class VideoController extends AdminController
{
    public function index()
    {
        $videos = Video::all();
        return view('admin.video.index', compact('videos'));
    }

    public function destroy($id)
    {
        $video = Video::find($id);
        $course = Course::find($video->course_id);
        $courseTime = $course->time;
        $courseTime = $courseTime - $video->time;
        $course->time = $courseTime;
        $course->save();

        Video::delete($id);
        return back();
    }
}
