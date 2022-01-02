<?php

namespace App\Http\Requests\Auth\Professor;

use System\Request\Request;

class RegisterRequest extends Request
{
    protected function rules(){
        return[
            'first_name' => 'required|max:191',
            'last_name' => 'required|max:191',
            'email' => 'required|max:64|email|unique:professors,email',
            'password' => 'required|min:8|confirmed',
            'image' => 'required|file|mimes:jpeg,jpg,png|max:2048',
            'description' => 'required|min:15',
            'conditions' => 'required'
        ];
    }
}