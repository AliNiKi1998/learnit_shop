<?php

namespace App\Http\Controllers\Admin;

use App\Professor;
use App\Http\Requests\Admin\ProfessorRequest;
use App\Http\Services\ImageUpload;

class ProfessorController extends AdminController
{
    public function index()
    {
        $professors = Professor::all();
        return view('admin.professor.index', compact('professors'));
    }

    public function edit($id)
    {
        $professor = Professor::find($id);
        return view('admin.professor.edit', compact('professor'));
    }

    public function update($id)
    {
        $request = new ProfessorRequest();
        $inputs = $request->all();
        if ($request->file('image')['tmp_name'] != '') {
            $path = 'images/professor/image/' . date('Y/M/d');
            $nameSmall = date('Y_m_d_H_i_s_') . rand(10, 99);
            $nameBig = date('Y_m_d_H_i_s_') . rand(10, 99);
            $inputs['image']['small'] = ImageUpload::UploadAndFitImage($request->file('image'), $path, $nameSmall, 50, 50);
            $inputs['image']['big'] = ImageUpload::UploadAndFitImage($request->file('image'), $path, $nameBig, 400, 350);
        }
        $updatables = ['first_name', 'last_name', 'image', 'description'];
        $inputs = array_intersect_key($inputs, array_flip($updatables));
        $inputs['id'] = $id;
        $inputs['description'] = trim($inputs['description'], ' ');
        Professor::update($inputs);
        return redirect('admin/professor');
    }

    public function destroy($id)
    {
        Professor::delete($id);
        return back();
    }

    public function changeStatus($id)
    {
        $professor = Professor::find($id);
        if ($professor->status == 1) {
            $professor->status = 0;
        } else {
            $professor->status = 1;
        }
        $professor->save();
        return back();
    }
}
