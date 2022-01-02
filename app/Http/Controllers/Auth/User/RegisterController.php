<?php

namespace App\Http\Controllers\Auth\User;

use App\User;
use App\Http\Requests\Auth\User\RegisterRequest;
use App\Http\Services\ImageUpload;
use App\Http\Services\MailService;

class RegisterController
{
    private $redirectTo = "/login";
    private $redirectToAdmin = "/adminlogin";

    public function view()
    {
        return view("auth.user.register");
    }

    public function adminview()
    {
        return view("admin.login.register");
    }

    public function register()
    {
        $request = new RegisterRequest();
        $inputs = $request->all();
        $path = 'images/users/avatar/' . date('Y/M/d');
        $name = date('Y_m_d_H_i_s_') . rand(10, 99);
        $inputs['avatar'] = ImageUpload::UploadAndFitImage($request->file('avatar'), $path, $name, 80, 80);
        $inputs['verify_token'] = generateToken();
        $inputs['is_active'] = 0;
        $inputs['user_type'] = 'user';
        $inputs['status'] = 0;
        $inputs['remember_token'] = null;
        $inputs['remember_token_expire'] = null;
        $inputs['password'] = password_hash($request->password, PASSWORD_DEFAULT);
        User::create($inputs);
        $message = '
       <h2 style="font-family: tahoma; font-size: 18px; text-align: center;">ایمیل فعال سازی</h2>
        <p style="font-size: 15px; font-family: tahoma;">کاربر گرامی ثبت نام شما با موفقیت صورت گرفت برای فعال سازی حساب کاربری خود روی لینک زیر کلیک کنید</p>
        <p style="display: inline-block; padding: 5px 10px; background: #218838; border-radius: 3px;">
            <a style="color: #fff;" href="' . route('auth.activation', [$inputs['verify_token']]) . '">فعال سازی حساب کاربری</a>
        </p>
       ';
        $mailService = new MailService();
        $mailService->send($inputs['email'], 'ایمیل فعال سازی', $message);
        flash('register', 'ایمیل فعال سازی با موفقیت ارسال شد');
        return redirect($this->redirectTo);
    }

    public function activation($token)
    {
        $user = User::where('verify_token', $token)->get();
        if (empty($user)) {
            flash('activation', 'فعال سازی با موفقیت انجام نشد');
            return redirect($this->redirectTo);
        }

        $user = $user[0];
        $user->is_active = 1;
        $user->save();
        flash('activation', 'فعال سازی با موفقیت انجام شد');
        return redirect($this->redirectTo);
    }
}
