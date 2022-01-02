<?php

namespace App\Http\Controllers\Home;

use System\Auth\Auth;
use App\Http\Requests\Home\CourseRequest;
use App\Http\Services\ImageUpload;
use App\Course;
use App\Category;
use App\UserCourse;
use System\Session\Session;

class CourseController extends HomeController
{
    private $redirectToLogin = '/professor/login';

    public function __construct()
    {
        if (Auth::professor($this->redirectToLogin)->user_type !== 'professor') {
            redirect($this->redirectToLogin);
            exit;
        }
    }


    public function show($id)
    {
        $course = Course::find($id);
        return view('home.course.show', compact('course'));
    }

    public function create()
    {
        $categories = Category::where('parent_id', '!=', 0)->get();
        return view('home.course.create', compact('categories'));
    }

    public function store()
    {
        $request = new CourseRequest();
        $inputs = $request->all();
        $categories = Category::where('parent_id', '!=', 0)->get();
        $catId = [];
        foreach ($categories as $category) {
            array_push($catId, $category->id);
        }

        if (!in_array($inputs['cat_id'], $catId)) {
            error('cat_id', 'دسته بندی غیر مجاز!!!');
            return back();
        }
        $inputs['professor_id'] = Auth::professor()->id;
        $file = $request->file('image');
        $path = 'images/course/image/' . date('Y/M/d');
        $name = date('Y_m_d_H_i_s_') . rand(10, 99);
        $nameSmall = date('Y_m_d_H_i_s_') . rand(10, 99);
        $nameBig = date('Y_m_d_H_i_s_') . rand(10, 99);
        $inputs['image']['small'] = ImageUpload::UploadAndFitImage($file, $path, $nameSmall, 300, 300);
        $inputs['image']['big'] = ImageUpload::UploadAndFitImage($file, $path, $nameBig, 730, 420);
        Course::create($inputs);
        return redirect('/professor');
    }


    public function edit($id)
    {
        $categories = Category::where('parent_id', '!=', 0)->get();
        $course = Course::find($id);
        @Session::set('referer', $_SERVER['HTTP_REFERER']);
        return view('home.course.edit', compact('categories', 'course'));
    }

    public function update($id)
    {
        $request = new CourseRequest();
        $inputs = $request->all();
        $inputs['id'] = $id;
        $categories = Category::where('parent_id', '!=', 0)->get();
        $catId = [];
        foreach ($categories as $category) {
            array_push($catId, $category->id);
        }
        if (!in_array($inputs['cat_id'], $catId)) {
            error('cat_id', 'دسته بندی غیر مجاز!!!');
            return back();
        }

        $file = $request->file('image');
        if ($file['tmp_name'] != '') {
            $path = 'images/course/image/' . date('Y/M/d');
            $nameSmall = date('Y_m_d_H_i_s_') . rand(10, 99);
            $nameBig = date('Y_m_d_H_i_s_') . rand(10, 99);
            $inputs['image']['small'] = ImageUpload::UploadAndFitImage($file, $path, $nameSmall, 300, 300);
            $inputs['image']['big'] = ImageUpload::UploadAndFitImage($file, $path, $nameBig, 730, 420);
        }
        Course::update($inputs);
        $userCourses = UserCourse::where('course_id' , $id)->whereNull('payment_code')->get();
        foreach($userCourses as $userCourse){
            $userCourse->price = $inputs['price'];
            $userCourse->save();    
        }
        $redirect = Session::get('referer');
        empty($redirect) ? $redirect = '/professor' : $redirect;
        Session::remove('referer');
        return redirect($redirect);
    }

    public function destroy($id)
    {
        $userCourse = UserCourse::where('course_id', $id)->whereNotNull('payment_code')->get();
        if (empty($userCourse)) {
            Course::delete($id);
            error('course_removed', 'دوره با موفقیت حذف شد');
            return back();
        }
        error('student_exist', 'مجاز به حذف دوره نمی باشید شامل دانشجو می باشد');
        return back();
    }
}
