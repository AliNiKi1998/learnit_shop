<?php

namespace App\Http\Controllers\Home;

use App\Cart;
use App\Course;
use App\Http\Requests\Home\User\UserChangePasswordRequest;
use App\Http\Requests\Home\User\UserChangeProfileRequest;
use App\Http\Services\ImageUpload;
use App\User;
use App\UserCourse;
use System\Auth\Auth;

class UserController extends HomeController
{


    public function __construct()
    {
        if (Auth::checkLogin() == false) {
            redirect('/login');
        }
    }

    public function show()
    {
        $user = Auth::user();
        $userCourses = UserCourse::where('user_id', $user->id)->whereNotNull('payment_code')->get();
        $allCourse = [];
        foreach ($userCourses as $userCourse) {
            $courses = Course::where('id', $userCourse->course_id)->get();
            foreach ($courses as $course) {
                array_push($allCourse, $course);
            }
        }
        return view('home.user.show', compact('user', 'allCourse'));
    }

    public function changePasswordShow()
    {
        $user = Auth::user();
        return view('home.user.change-password', compact('user'));
    }

    public function changePassword($id)
    {
        $user = User::find($id);
        $request = new UserChangePasswordRequest();
        $inputs = $request->all();
        if (password_verify($inputs['old_password'],  $user->password) == false) {
            error('old_password', 'پسور وارد شده صحیح نمی باشد');
            return back();
        }
        if ($inputs['password'] != $inputs['confirm_password']) {
            error('confirm_password', 'پسورد جدید و تکرارا پسورد مطابقت ندارد!!!');
            return back();
        }
        $user->password = password_hash($inputs['password'], PASSWORD_DEFAULT);
        $user->save();
        redirect('/user');
    }

    public function changeProfileShow()
    {
        $user = Auth::user();
        return view('home.user.change-profile', compact('user'));
    }

    public function changeProfile($id)
    {
        $request = new UserChangeProfileRequest();
        $path = 'images/users/avatar/' . date('Y/M/d');
        $name = date('Y_m_d_H_i_s_') . rand(10, 99);
        $inputs['avatar'] = ImageUpload::UploadAndFitImage($request->file('avatar'), $path, $name, 80, 80);
        $user = User::find($id);
        $user->avatar = $inputs['avatar'];
        $user->save();
        return redirect('/user');
    }

    public function cart()
    {
        $user = Auth::user();
        $purchases = Cart::where('user_id', $user->id)->get();
        return view('home.user.cart', compact('user', 'purchases'));
    }
}
