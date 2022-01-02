<?php

namespace App\Http\Controllers\Home;

use App\Comment;
use App\Course;
use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Home\NewsLatterRequest;
use App\NewsLatter;
use App\Professor;

class HomeController extends Controller
{

    public function index()
    {
        $allCourse = Course::all();
        $allUser = User::where('user_type', '!=', 'admin')->get();
        $allProfessor = Professor::all();
        $allComment = Comment::all();
        $lastComments = Comment::whereNull('professor_id')->orderBy('created_at', 'DESC')->limit(0, 8)->get();
        $lastCourses = Course::orderBy('created_at', 'DESC')->limit(0, 10)->get();
        $suggestedCourses = Course::where('status', 1)->orderBy('created_at', 'DESC')->limit(0, 10)->get();
        return view('home.index', compact('allCourse', 'allUser', 'allProfessor', 'allComment', 'lastComments', 'lastCourses', 'suggestedCourses'));
    }

    public function search()
    {
        //tag
        if (isset($_GET['searchTag']) && !empty($_GET['searchTag']) && !ctype_space($_GET['searchTag']) && $_SERVER['REQUEST_URI'] != '/search?search=') {
            $tag = '%' . $_GET['searchTag'] . '%';
            $courses = Course::where('tags', 'LIKE', $tag)->get();
            return view('home.layouts.search', compact('courses'));
        } //search
        elseif (isset($_GET['search']) && !empty($_GET['search']) && !ctype_space($_GET['search']) && $_SERVER['REQUEST_URI'] != '/search?search=') {
            $search = '%' . $_GET['search'] . '%';
            $courses = Course::where('name', 'LIKE', $search)->get();
            return view('home.layouts.search', compact('courses'));
        } else {
            return back();
        }
    }

    public function newsLatter()
    {
        $request = new NewsLatterRequest();
        $inputs = $request->all();
        NewsLatter::create($inputs);
        error('email', 'ایمیل شما با موفقیت در خبرنامه ثبت شد');
        return back();
    }

    public function professorAll($id)
    {
        $professor = Professor::find($id);
        $professorAllCourse = Course::where('professor_id', $id)->get();
        return view('home.all.professor-all-course', compact('professor', 'professorAllCourse'));
    }

    public function allCourse()
    {
        $allCourse = Course::all();
        return view('home.all.all-course', compact('allCourse'));
    }
}
