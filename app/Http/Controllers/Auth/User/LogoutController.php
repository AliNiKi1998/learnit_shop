<?php

namespace App\Http\Controllers\Auth\User;

use System\Auth\Auth;

class LogoutController
{
    private $redirectTo = '/home';
    private $redirectToAdmin = '/adminlogin';

    public function logout()
    {
        Auth::logout();
        return redirect($this->redirectTo);
    }

    public function adminLogout()
    {
        Auth::logout();
        return redirect($this->redirectToAdmin);
    }
}
