<?php

namespace App\Http\Controllers\Home;

use System\Auth\Auth;
use App\Http\Services\VideoUpload;
use App\Http\Requests\Home\VideoRequest;
use App\Video;
use App\Course;

class VideoController extends HomeController
{
    private $redirectToLogin = '/professor/login';

    public function __construct()
    {
        if (Auth::professor($this->redirectToLogin)->user_type !== 'professor') {
            redirect($this->redirectToLogin);
            exit;
        }
    }

    public function list($courseId)
    {
        $course = Course::find($courseId);
        $videos = Video::where('course_id', $courseId)->get();
        return view('home.video.index', compact('course', 'videos'));
    }

    public function create($id)
    {
        return view('home.video.create', compact('id'));
    }

    public function store($id)
    {
        $request = new VideoRequest();
        $inputs = $request->all();
        if ($inputs['time'] == 0) {
            $inputs['time'] = 1;
        }

        $course = Course::find($id);
        $courseTime = $course->time;
        $courseTime += $inputs['time'];
        $course->time = $courseTime;
        $course->save();

        $inputs['professor_id'] = Auth::professor()->id;
        $inputs['course_id'] = $id;
        $inputs['status'] = 1;
        $file = $request->file('video');
        $path = 'videos/courses/' . date('Y/M/d');
        $name = date('Y_m_d_H_i_s_') . rand(10, 99);
        $inputs['video'] = VideoUpload::uploader($file, $path, $name);
        Video::create($inputs);
        return redirect('/course/video/list/' . $id);
    }

    public function edit($id)
    {
        $video = Video::find($id);
        return view('home.video.edit', compact('video'));
    }

    public function update($id)
    {
        $request = new VideoRequest();
        $inputs = $request->all();
        if ($inputs['time'] == '') {
            unset($inputs['time']);
        }
        $inputs['id'] = $id;
        $file = $request->file('video');
        $video = $video = Video::find($id);
        if ($file['tmp_name'] != '') {
            $path = 'videos/courses/' . date('Y/M/d');
            $name = date('Y_m_d_H_i_s_') . rand(10, 99);
            $inputs['video'] = VideoUpload::uploader($file, $path, $name);

            $course = Course::find($video->course_id);
            $courseTime = $course->time;
            $courseTime = $courseTime - $video->time;
            $courseTime += $inputs['time'];
            $course->time = $courseTime;
            $course->save();
        }
        Video::update($inputs);
        return redirect('/course/video/list/' . $video->course_id);
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

    public function changeStatus($id)
    {
        $video = Video::find($id);
        if ($video->status == 1) {
            $video->status = 0;
        } else {
            $video->status = 1;
        }
        $video->save();
        return back();
    }
}
