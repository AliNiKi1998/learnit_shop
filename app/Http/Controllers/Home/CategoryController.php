<?php

namespace App\Http\Controllers\Home;

use App\Course;

class CategoryController extends HomeController
{
    public function show($id)
    {
        $courses  = Course::where('cat_id' , $id)->get();
        return view('home.course.index' , compact('courses'));
    }
}
