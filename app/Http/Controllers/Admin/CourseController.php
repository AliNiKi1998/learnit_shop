<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Category;
use App\UserCourse;
use App\Http\Requests\Admin\CourseRequest;
use App\Http\Services\ImageUpload;

class CourseController extends AdminController
{
    public function index()
    {
        $courses = Course::all();
        return view('admin.course.index', compact('courses'));
    }

    public function edit($id)
    {
        $course = Course::find($id);
        $categories = Category::where('parent_id', '!=', 0)->get();
        return view('admin.course.edit', compact('course' , 'categories'));
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
        return redirect('/admin/course');
    }

    public function destroy($id)
    {
        $userCourse = UserCourse::where('course_id' , $id)->whereNotNull('payment_code')->get();
        if(empty($userCourse)){
            Course::delete($id);
            error('course_removed' , 'دوره با موفقیت حذف شد');
            return back(); 
        }
        error('student_exist' , 'مجاز به حذف دوره نمی باشید شامل دانشجو می باشد');
        return back();
    }

    public function changeStatus($id)
    {
        $course = Course::find($id);
        if ($course->status == 1) {
            $course->status = 0;
        } else {
            $course->status = 1;
        }
        $course->save();
        return back();
    }
}
