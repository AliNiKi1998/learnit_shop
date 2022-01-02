<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Services\ImageUpload;
use System\Auth\Auth;

class UserController extends AdminController
{
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit', compact('user'));
    }

    public function update($id)
    {
        $request = new UserRequest();
        $inputs = $request->all();
        checkValidValue('user_type', $inputs['user_type'], ['admin', 'user', 'writer']);
        if ($request->file('avatar')['tmp_name'] != '') {
            $path = 'images/users/avatar/' . date('Y/M/d');
            $name = date('Y_m_d_H_i_s_') . rand(10, 99);
            $inputs['avatar'] = ImageUpload::UploadAndFitImage($request->file('avatar'), $path, $name, 80, 80);
        }
        $updatables = ['first_name', 'last_name' , 'avatar' , 'user_type'];
        $inputs = array_intersect_key($inputs, array_flip($updatables));
        $inputs['id'] = $id;
        User::update($inputs);
        return redirect('admin/user');
    }

    public function destroy($id)
    {
        $userLogin = Auth::user()->id;
        if ($userLogin == $id) {
            error('user_login', 'مجاز به حذف کاربر لاگین شده نمی باشید');
            return back();
        }
        User::delete($id);
        return back();
    }

    public function changeStatus($id)
    {
        $user = User::find($id);
        if ($user->status == 1) {
            $user->status = 0;
        } else {
            $user->status = 1;
        }
        $user->save();
        return back();
    }
}
