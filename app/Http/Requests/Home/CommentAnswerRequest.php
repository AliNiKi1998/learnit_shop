<?php

namespace App\Http\Requests\Home;

use System\Request\Request;

class CommentAnswerRequest extends Request
{
    public function rules()
    {
        return [
            'comment' => 'required|max:500|min:10',
        ];
    }
}
