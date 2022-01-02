<?php

namespace App\Http\Requests\Home;

use System\Request\Request;

class VideoRequest extends Request
{
    public function rules()
    {
        if (methodField() == 'put') {
            return [
                'name' => 'required|max:191',
                'video' => 'file|mimes:mp4|max:307200',
            ];
        } else {
            return [
                'name' => 'required|max:191',
                'video' => 'required|file|mimes:mp4|max:307200',
            ];
        }
    }
}
