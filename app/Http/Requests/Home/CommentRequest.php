<?php

namespace App\Http\Requests\Home;

use System\Request\Request;

class CommentRequest extends Request
{
    public function rules()
    {
        return [
            'comment' => 'required|max:500|min:10',
            'score' => 'required|number'
        ];
    }
}
