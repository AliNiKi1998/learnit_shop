<?php

namespace App\Http\Requests\Home\User;

use System\Request\Request;

class UserChangePasswordRequest extends Request
{
    public function rules()
    {

        return [
            'password' => 'required|min:8|confirmed',
            'old_password' => 'required|min:8'
        ];
    }
}
