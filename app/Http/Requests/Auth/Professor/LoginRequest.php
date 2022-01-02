<?php

namespace App\Http\Requests\Auth\Professor;

use System\Request\Request;

class LoginRequest extends Request
{
    protected function rules(){
        return[
            'email' => 'required|max:191|email',
            'password' => 'required'
        ];
    }
}