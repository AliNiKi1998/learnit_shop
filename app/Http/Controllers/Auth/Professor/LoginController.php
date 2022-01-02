<?php

namespace App\Http\Controllers\Auth\Professor;

use App\Http\Requests\Auth\Professor\LoginRequest;
use App\Professor;
use System\Auth\Auth;
use System\Cookie\Cookie;

class LoginController
{

    private $redirectToProfessor = "/professor";
    private $redirectToHome = "/home";

    public function view()
    {
        if (Auth::checkLoginProfessor()) {
            if (Auth::professor()->user_type == "professor") {
                return redirect($this->redirectToProfessor);
                exit;
            }
        }
        return view("auth.professor.login");
    }

    public function login()
    {
        Auth::logoutOther('professor');
        Auth::logoutOther('blogger');
        Auth::logout();
        $request = new LoginRequest();
        $user = Professor::where('email', $request->email)->get();
        $user = $user[0];

        if ($user == '') {
            error('exist', 'ایمیل یا رمز عبور اشتباه می باشد');
            return back();
        }
        if ($user->is_active == 0) {
            error('active', 'ایمیل شما تایید شده نیست لطفا ایمیل خو را تایید کنید');
            return back();
        }
        if ($user->user_type != 'professor') {
            error('active', 'در حال حاضر اجازه ورود ندارید..!!!');
            return back();
        }
        if (Auth::loginByEmailProfessor($request->email, $request->password)) {
            if ($request->remember == 'ok') {
                Cookie::set('email', $request->email, 10 * 86400);
                Cookie::set('password', $request->password, 10 * 86400);
            }
            if ($user->user_type == 'professor') {
                return redirect($this->redirectToProfessor);
            } else {
                return redirect($this->redirectToHome);
            }
        } else {
            return back();
        }
    }
}
