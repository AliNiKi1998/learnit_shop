<?php

namespace App\Http\Requests\Home;

use System\Request\Request;

class CourseRequest extends Request
{
    public function rules()
    {
        if (methodField() == 'put') {
            return [
                'name' => 'required|max:191',
                'cat_id' => 'required|exists:categories,id',
                'price' => 'required|number',
                'image' => 'file|mimes:jpeg,jpg,png|max:2048',
                'description' => 'required|min:50',
                'tags' => 'required|max:225',
            ];
        } else {
            return [
                'name' => 'required|max:191',
                'cat_id' => 'required|exists:categories,id',
                'price' => 'required|number',
                'image' => 'required|file|mimes:jpeg,jpg,png|max:2048',
                'description' => 'required|min:50',
                'tags' => 'required|max:225',
            ];
        }
    }
}
