<?php

namespace App\Http\Controllers\Admin;

use App\NewsLatter;

class NewsLatterController extends AdminController
{
    public function index()
    {
        $emails = NewsLatter::all();
        return view('admin.newslatter.index' , compact('emails'));
    }
}
