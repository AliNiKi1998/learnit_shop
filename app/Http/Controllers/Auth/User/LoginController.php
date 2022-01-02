<?php

namespace App\Http\Controllers\Auth\User;


use App\Http\Requests\Auth\User\LoginRequest;
use App\User;
use System\Auth\Auth;
use System\Cookie\Cookie;

class LoginController
{

    private $redirectTo = "/home";
    private $redirectToAdmin = "/admin";

    public function view()
    {
        if (Auth::checkLogin()) {
            if (Auth::user()->user_type == "user") {
                return redirect($this->redirectTo);
                exit;
            }
        }
        return view("auth.user.login");
    }

    public function adminView()
    {
        if (Auth::checkLogin()) {
            if (Auth::user()->user_type == "admin") {
                return redirect($this->redirectToAdmin);
                exit;
            }
        }
        return view("admin.login.login");
    }

    public function login()
    {
        Auth::logout();
        Auth::logoutOther('professor');
        Auth::logoutOther('blogger');
        $request = new LoginRequest();
        $user = User::where('email', $request->email)->get();
        $user = $user[0];

        if ($user == '') {
            error('exist', 'ایمیل یا رمز عبور اشتباه می باشد');
            return back();
        }
        if ($user->is_active == 0) {
            error('active', 'ایمیل شما تایید شده نیست لطفا ایمیل خو را تایید کنید');
            return back();
        }
        if (Auth::loginByEmail($request->email, $request->password)) {
            if ($request->remember == 'ok') {
                Cookie::set('email', $request->email, 10 * 86400);
                Cookie::set('password', $request->password, 10 * 86400);
            }
            if ($user->user_type == 'admin') {
                return redirect($this->redirectToAdmin);
            } else {
                return redirect($this->redirectTo);
            }
        } else {
            return back();
        }
    }
}
