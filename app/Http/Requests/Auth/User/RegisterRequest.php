<?php

namespace App\Http\Requests\Auth\User;

use System\Request\Request;

class RegisterRequest extends Request
{
    protected function rules(){
        return[
            'first_name' => 'required|max:191',
            'last_name' => 'required|max:191',
            'email' => 'required|max:64|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'avatar' => 'required|file|mimes:jpeg,jpg,png|max:2048',
            'conditions' => 'required'
        ];
    }
}