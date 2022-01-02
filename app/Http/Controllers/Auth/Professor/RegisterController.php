<?php

namespace App\Http\Controllers\Auth\Professor;

use App\Professor;
use App\Http\Requests\Auth\Professor\RegisterRequest;
use App\Http\Services\ImageUpload;
use App\Http\Services\MailService;

class RegisterController
{
    private $redirectTo = "/professor/login";

    public function view()
    {
        return view("auth.professor.register");
    }

    public function register()
    {
        $request = new RegisterRequest();
        $inputs = $request->all();
        $path = 'images/professor/image/' . date('Y/M/d');
        $nameSmall = date('Y_m_d_H_i_s_') . rand(10, 99);
        $nameBig = date('Y_m_d_H_i_s_') . rand(10, 99);
        $inputs['image']['small'] = ImageUpload::UploadAndFitImage($request->file('image'), $path, $nameSmall, 50, 50);
        $inputs['image']['big'] = ImageUpload::UploadAndFitImage($request->file('image'), $path, $nameBig, 400, 350);
        $inputs['verify_token'] = generateToken();
        $inputs['is_active'] = 0;
        $inputs['user_type'] = 'professor';
        $inputs['status'] = 0;
        $inputs['remember_token'] = null;
        $inputs['remember_token_expire'] = null;
        $inputs['password'] = password_hash($request->password, PASSWORD_DEFAULT);
        Professor::create($inputs);
        $message = '      
        <h2 style="font-family: tahoma; font-size: 18px; text-align: center;">ایمیل فعال سازی</h2>
        <p style="font-size: 15px; font-family: tahoma;">استاد گرامی ثبت نام شما با موفقیت صورت گرفت برای فعال سازی حساب کاربری خود روی لینک زیر کلیک کنید</p>
        <p style="display: inline-block; padding: 5px 10px; background: #218838; border-radius: 3px;">
            <a style="color: #fff;" href="' . route('auth.professor.activation', [$inputs['verify_token']]) . '">فعال سازی حساب کاربری</a>
        </p>
       ';
        $mailService = new MailService();
        $mailService->send($inputs['email'], 'ایمیل فعال سازی', $message);
        flash('register', 'ایمیل فعال سازی با موفقیت ارسال شد');
        return redirect($this->redirectTo);
    }

    public function activation($token)
    {
        $professor = Professor::where('verify_token', $token)->get();
        if (empty($professor)) {
            flash('activation', 'فعال سازی با موفقیت انجام نشد');
            return redirect($this->redirectTo);
        }

        $professor = $professor[0];
        $professor->is_active = 1;
        $professor->save();
        flash('activation', 'فعال سازی با موفقیت انجام شد');
        return redirect($this->redirectTo);
    }
}
