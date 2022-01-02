<?php

namespace App\Http\Requests\Admin;

use System\Request\Request;

class SettingRequest extends Request
{
    public function rules()
    {
        if (methodField() == 'put') {
            return [
                'email' => 'required|email|max:191',
                'phone' => 'required|number',
                'description' => 'required',
                'location' => 'required|max:191',
                'telegram' => 'required|max:191',
                'instagram' => 'required|max:191',
                'facebook' => 'required|max:191',
            ];
        }
    }
}
