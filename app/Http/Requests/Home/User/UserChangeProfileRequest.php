<?php

namespace App\Http\Requests\Home\User;

use System\Request\Request;

class UserChangeProfileRequest extends Request
{
    public function rules()
    {

        return [
            'avatar' => 'required|file|mimes:jpeg,jpg,png|max:2048',
        ];
    }
}
