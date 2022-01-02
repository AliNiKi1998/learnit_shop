<?php

namespace App\Http\Requests\Auth\User;

use System\Request\Request;

class ForgotRequest extends Request
{
    protected function rules()
    {
        return [
            'email' => 'required|max:191|email|exists:users,email'
        ];
    }
}
