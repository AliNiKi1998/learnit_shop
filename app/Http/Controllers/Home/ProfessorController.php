<?php

namespace App\Http\Controllers\Home;

use App\Comment;
use App\Course;
use System\Auth\Auth;
use App\Http\Requests\Home\ProfessorRequest;
use App\Http\Services\ImageUpload;
use App\Professor;
use App\UserCourse;

class ProfessorController extends HomeController
{

    private $redirectToLogin = '/professor/login';

    public function __construct()
    {
        if (Auth::professor($this->redirectToLogin)->user_type !== 'professor') {
            redirect($this->redirectToLogin);
            exit;
        }
    }


    public function show()
    {
        $professorId = Auth::professor('/professor')->id;
        $courses = Course::where('professor_id', $professorId)->get();
        //get count comment and student and income
        $coursesId = [];
        foreach ($courses as $courseId) {
            array_push($coursesId, $courseId->id);
        }
        $allComment = [];
        $allStudent = [];
        $Incomes = [];
        foreach ($coursesId as $id) {
            $countComment = count(Comment::where('course_id', $id)->where('approved', 1)->get());
            $countStudent = count(UserCourse::where('course_id', $id)->whereNotNull('payment_code')->get());
            array_push($allComment, $countComment);
            array_push($allStudent, $countStudent);
            array_push($Incomes, UserCourse::where('course_id', $id)->whereNotNull('payment_code')->get());
        }
        $income = [];
        foreach ($Incomes as $price) {
            array_push($income , @$price[0]->price);
        }
        $income = array_sum($income);
        $allComment = array_sum($allComment);
        $allStudent = array_sum($allStudent);
        //end
        $professor = Professor::find($professorId);
        return view('home.professor.show', compact('courses', 'professor', 'allComment', 'allStudent' , 'income'));
    }

    public function editInfo()
    {

        return view('home.professor.edit_info');
    }

    public function updateInfo($id)
    {
        $request = new ProfessorRequest();
        $inputs = $request->all();
        $file = $request->file('image');
        if ($file['tmp_name'] != '') {
            $path = 'images/professor/image/' . date('Y/M/d');
            $nameSmall = date('Y_m_d_H_i_s_') . rand(10, 99);
            $nameBig = date('Y_m_d_H_i_s_') . rand(10, 99);
            $inputs['image']['small'] = ImageUpload::UploadAndFitImage($request->file('image'), $path, $nameSmall, 50, 50);
            $inputs['image']['big'] = ImageUpload::UploadAndFitImage($request->file('image'), $path, $nameBig, 400, 350);
        }

        $updatables = ['first_name', 'last_name', 'image', 'description', 'telegram', 'instagram', 'facebook'];
        $inputs = array_intersect_key($inputs, array_flip($updatables));
        $inputs['description'] = trim($inputs['description'], ' ');
        $inputs['id'] = $id;
        Professor::update($inputs);
        flash('update_info', 'ویرایش اطلاعات با موفقیت انجام شد');
        redirect('/professor');
    }
}
