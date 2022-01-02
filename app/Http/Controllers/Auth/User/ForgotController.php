<?php

namespace App\Http\Controllers\Auth\User;

use App\Http\Requests\Auth\User\ForgotRequest;
use App\Http\Services\MailService;
use App\User;
use System\Session\Session;

class ForgotController
{

    private $redirectTo = '/home';
    private $redirectToAdmin = '/admin';

    public function view()
    {
        return view('auth.user.forgot');
    }

    public function forgot()
    {
        if (Session::get('forgot.time') != false && Session::get('forgot.time') > time()) {
            error('forgot', 'لطفا 2 دقیقه صبر کنید و دوباره تلاش کنید');
            return back();
        } else {
            $request = new ForgotRequest();
            $inputs = $request->all();
            $user = User::where('email', $inputs['email'])->get();
            if (empty($user)) {
                error('forgot', 'کاربر وجود ندارد');
                return back();
            }
            Session::set('forgot.time', time() + 120);
            $user = $user[0];
            $user->remember_token = generateToken();
            $user->remember_token_expire = date("Y-m-d H:i:s", strtotime(' + 10 min'));
            $user->save();
            $message = '
            <h2 style="font-family: tahoma; font-size: 18px; text-align: center;">ایمیل بازیابی رمز عبور </h2>
            <p style="font-size: 15px; font-family: tahoma;">کاربر گرامی برای بازیابی رمز عبور خود از لینک زیر استفاده نمایید</p>
            <p style="display: inline-block; padding: 5px 10px; background: #218838; border-radius: 3px;">
                <a style="color: #fff;" href="' . route('auth.reset-password.view', [$user->remember_token]) . '">بازیابی رمز عبور</a>
            </p>
            ';
            $mailService = new MailService();
            $mailService->send($inputs['email'], 'ایمیل بازیابی رمز عبور', $message, 'email reset password');
            flash('forgot', 'ایمیل بازیابی با موفقیت ارسال شد');
            return redirect($this->redirectTo);
        }
    }
}
