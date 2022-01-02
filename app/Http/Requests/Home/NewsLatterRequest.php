<?php

namespace App\Http\Requests\Home;

use System\Request\Request;

class NewsLatterRequest extends Request
{
    public function rules()
    {
        return [
            'email' => 'required|email|unique:news_letter_email,email',
        ];
    }
}
