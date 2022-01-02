<?php

namespace App\Http\Requests\Admin;

use System\Request\Request;

class CourseRequest extends Request
{
    public function rules()
    {
        return [
            'name' => 'required|max:191',
            'cat_id' => 'required|exists:categories,id',
            'price' => 'required|number',
            'image' => 'file|mimes:jpeg,jpg,png|max:2048',
            'description' => 'required|min:50',
            'tags' => 'required|max:225',
        ];
    }
}
