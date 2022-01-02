<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Course;
use App\Http\Requests\Admin\CategoryRequest;

class CategoryController extends AdminController
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::where('parent_id', 0)->get();
        return view('admin.category.create', compact('categories'));
    }

    public function store()
    {
        $request = new CategoryRequest();
        $inputs = $request->all();
        Category::create($inputs);
        return redirect('admin/category');
    }

    public function edit($id)
    {
        $currentCategory = Category::find($id);
        $categories = Category::where('parent_id', 0)->get();
        return view('admin.category.edit', compact('currentCategory', 'categories'));
    }

    public function update($id)
    {
        $request = new CategoryRequest();
        $inputs = $request->all();
        $inputs['id'] = $id;
        $categories = Category::all();
        Category::update($inputs);
        return redirect('admin/category');
    }

    public function destroy($id)
    {
        $course = Course::where('cat_id', $id)->get();
        $category = Category::where('parent_id' , $id)->get();
        if ($category != null) {
            error('has_category', 'مجاز به حذف کردن این دسته بندی نمی باشید !!! این دسته بندی شامل زیر دسته می باشد');
            return back();
        }
        if ($course != null) {
            error('has_course', 'مجاز به حذف کردن این دسته بندی نمی باشید !!! این دسته بندی شامل دوره می باشد');
            return back();
        }
        Category::delete($id);
        return back();
    }
}
