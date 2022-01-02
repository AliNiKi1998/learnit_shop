<?php

namespace App\Http\Controllers\Home;

use System\Auth\Auth;
use App\Course;
use App\Professor;
use App\UserCourse;
use App\Video;
use App\Comment;

class CourseShowController extends HomeController
{
    public function show($id)
    {
        $course = Course::find($id);
        $videos = Video::where('course_id', $course->id)->get();
        $comments = Comment::where('course_id', $id)->where('approved', 1)->whereNull('parent_id')->get();
        //show last course
        $lastCourses = Course::orderBy('created_at', 'DESC')->limit(0, 5)->get();
        //end show last course
        
        //show linked course
        $courseTags = explode(',', $course->tags);
        $where = [];

        foreach ($courseTags as $key => $courseTag) {
            $search = '%' . $courseTag . '%';
            if ($key == 0) {
                $where[0] = $search;
            }
            if ($key == 1) {
                $where[1] = $search;
            }
            if ($key == 2) {
                $where[2] = $search;
            }
        }

        if (!isset($where[1]) && !isset($where[2])) {
            $coursesLiked = Course::where('tags', 'LIKE', $where[0])->limit(0, 5)->get();
        } elseif (!isset($where[2])) {
            $coursesLiked = Course::where('tags', 'LIKE', $where[0])->whereOr('tags', 'LIKE', $where[1])->limit(0, 5)->get();
        } elseif (isset($where[2])) {
            $coursesLiked = Course::where('tags', 'LIKE', $where[0])->whereOr('tags', 'LIKE', $where[1])->whereOr('tags', 'LIKE', $where[2])->limit(0, 5)->get();
        }
        //end show linked course
        $scores = [];
        foreach ($comments as $comment) {
            array_push($scores, $comment->score);
        }
        $scoreCount = count($scores);
        $score = 0;
        $scoreSum = array_sum($scores);
        if ($scoreSum != 0) {
            $score = ($scoreSum / $scoreCount);
        }
        $score = substr($score, 0, 3);

        if (Auth::checkLoginProfessor()) {
            $professor = Professor::find(Auth::professor()->id);
        }
        $permision = [];
        if (Auth::checkLogin()) {
            $permision = UserCourse::where('user_id', Auth::user()->id)->where('course_id', $course->id)->whereNotNull('payment_code')->get();
        }
        if (isset($professor)) {
            array_push($permision, $professor);
        }

        return view('home.course.show', compact('course', 'videos', 'permision', 'comments', 'score', 'coursesLiked' , 'lastCourses'));
    }

    public function download($id)
    {
        if (Auth::checkLogin()) {
            $video = Video::find($id);
            $videoLink = url($video->video);
            redirect($videoLink);
        }
        redirect('home');
    }
}
