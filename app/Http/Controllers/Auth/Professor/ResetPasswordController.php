<?php

namespace App\Http\Controllers\Auth\Professor;

use App\Http\Requests\Auth\Professor\ResetPasswordRequest;
use App\Professor;

class ResetPasswordController
{

    private $redirectTo = 'professor/login';

    public function view($token)
    {
        $user = Professor::where('remember_token', $token)->where('remember_token_expire', '>=', date('Y-m-d H:i:s'))->get();
        if (empty($user)) {
            flash('reset_password', 'مجاز به تغیر پسور نمی باشید!!!');
            return redirect('/professor/forgot');
        }
        $user = $user[0];
        return view('auth.professor.reset', compact('token'));
    }

    public function resetPassword($token)
    {
        $request = new ResetPasswordRequest();
        $inputs = $request->all();
        $user = Professor::where('remember_token', $token)->where('remember_token_expire', '>=', date('Y-m-d H:i:s'))->get();
        if (empty($user)) {
            flash('reset_password', 'مجاز به تغیر پسور نمی باشید!!!');
            return redirect('/professor/forgot');
        }
        if ($inputs['password'] !== $inputs['new_password']) {
            error('new_password', 'مطابقت ندارد ');
            return back();
        }
        $user = $user[0];
        $user->password = password_hash($inputs['password'], PASSWORD_DEFAULT);
        $user->save();
        return redirect($this->redirectTo);
    }
}
