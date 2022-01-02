<?php

namespace App\Http\Controllers\Admin;

use System\Auth\Auth;
use App\Http\Controllers\Controller;
use App\User;
use App\Course;
use App\Http\Requests\Admin\SettingRequest;
use App\Professor;
use App\Video;
use App\Setting;

class AdminController extends Controller
{

    public function __construct()
    {
        if (Auth::user()->user_type != "admin") {
            redirect('/adminlogin');
            exit;
        }
    }
    public function index()
    {
        $admins = User::where('user_type', 'admin')->whereOr('user_type', 'writer')->get();
        view('admin.index', compact('admins'));
    }

    public function search()
    {
        if (isset($_GET['search']) && !empty($_GET['search']) && !ctype_space($_GET['search']) && $_SERVER['REQUEST_URI'] != '/admin/search?search=') {
            $search = '%' . $_GET['search'] . '%';
            $coursesSearch = Course::where('name', 'LIKE', $search)->whereOr('tags', 'LIKE', $search)->get();
            $usersSearch = User::where('first_name', 'LIKE', $search)->whereOr('last_name', 'LIKE', $search)->whereOr('email', 'LIKE', $search)->get();
            $professorsSearch = Professor::where('first_name', 'LIKE', $search)->whereOr('last_name', 'LIKE', $search)->whereOr('email', 'LIKE', $search)->get();
            $videsosSearch = Video::where('name', 'LIKE', $search)->get();
            return view('admin.layouts.search', compact('coursesSearch', 'usersSearch', 'professorsSearch', 'videsosSearch'));
        } else {
            return back();
        }
    }

    public function setting()
    {
        $setting = Setting::find(1);
        return view('admin.setting.index', compact('setting'));
    }

    public function editSetting()
    {
        $setting = Setting::find(1);
        return view('admin.setting.edit', compact('setting'));
    }

    public function updateSetting($id)
    {
        $request = new SettingRequest();
        $inputs = $request->all();
        $inputs['id'] = $id;
        $inputs['description'] = trim($inputs['description'], ' ');
        Setting::update($inputs);
        return redirect('/admin/setting');
    }
}
