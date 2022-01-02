<?php

namespace App\Http\Requests\Admin;

use System\Request\Request;

class ProfessorRequest extends Request
{
    public function rules()
    {
        if (methodField() == 'put') {
            return [
                'first_name' => 'required|max:191',
                'last_name' => 'required|max:191',
                'image' => 'file|mimes:jpeg,jpg,png|max:2048',
                'description' => 'required',
                'facebook' => 'max:191',
                'instagram' => 'max:191',
                'telegram' => 'max:191',
            ];
        } else {
            return [
                'first_name' => 'required|max:191',
                'last_name' => 'required|max:191',
                'email' => 'required|max:64|email|unique:professors,email',
                'password' => 'required|min:8|confirmed',
                'image' => 'required|file|mimes:jpeg,jpg,png|max:2048',
                'description' => 'required',
                'facebook' => 'max:191',
                'instagram' => 'max:191',
                'telegram' => 'max:191',
                
            ];
        }
    }
}
