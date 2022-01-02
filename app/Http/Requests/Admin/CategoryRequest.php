<?php

namespace App\Http\Requests\Admin;

use System\Request\Request;

class CategoryRequest extends Request
{
    public function rules()
    {
        if (methodField() == 'put') {
            return [
                'name' => 'required|max:191',
                'parent_id' => 'exists:categories,id',
            ];
        } else {
            return [
                'name' => 'required|max:191|unique:categories,name',
                'parent_id' => 'exists:categories,id',
            ];
        }
    }
}
