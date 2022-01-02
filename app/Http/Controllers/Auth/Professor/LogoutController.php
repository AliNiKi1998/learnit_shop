<?php

namespace App\Http\Controllers\Auth\Professor;

use System\Auth\Auth;

class LogoutController
{
    private $redirectTo = '/home';

    public function logout()
    {
        Auth::logoutOther('professor');
        return redirect($this->redirectTo);
    }
}
