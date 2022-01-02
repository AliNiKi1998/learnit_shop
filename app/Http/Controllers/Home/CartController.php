<?php

namespace App\Http\Controllers\Home;

use App\Course;
use App\UserCourse;
use System\Auth\Auth;

class CartController extends HomeController
{

    public function __construct()
    {
        if (Auth::checkLogin() == false) {
            error('not_login', 'برای خرید دوره وارد سایت شوید');
            return back();
        }
    }

    public function index()
    {
        $courses = UserCourse::where('user_id', Auth::user()->id)->whereNull('payment_code')->get();
        return view('home.cart.index', compact('courses'));
    }


    public function add($courseId)
    {
        $inputs['user_id'] = Auth::user()->id;
        $inputs['course_id'] = $courseId;
        $course = Course::find($courseId);
        $inputs['price'] = $course->price;
        $usersCourses = UserCourse::all();
        foreach ($usersCourses as $item) {
            if ($item->user_id == $inputs['user_id'] && $item->course_id == $inputs['course_id'] && $item->payment_code != NULL) {
                error('already_exist', 'شما این دوره را خریداری کرده اید');
                return back();
            }
            if ($item->user_id == $inputs['user_id'] && $item->course_id == $inputs['course_id']) {
                error('already_exist', 'این دوره از قبل داخل سبد شما موجود می باشد');
                return back();
            }
        }
        UserCourse::create($inputs);
        return back();
    }

    public function remove($id)
    {
        $course = UserCourse::find($id);
        if ($course->payment_code == NULL) {
            UserCourse::delete($id);
        }
        return back();
    }

    public function payment()
    {
        $courses = UserCourse::where('user_id', Auth::user()->id)->whereNull('payment_code')->get();

        $inputs = [];
        foreach ($courses as $course) {
            $inputs['id'] = $course->id;
            $inputs['payment_code'] = 'payment code valid';
            UserCourse::update($inputs);
        }
    }
}
