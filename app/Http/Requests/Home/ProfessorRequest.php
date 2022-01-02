<?php

namespace App\Http\Requests\Home;

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
                'description' => 'required|min:15',
                'facebook' => 'max:191',
                'instagram' => 'max:191',
                'telegram' => 'max:191',
            ];
        }
    }
}
