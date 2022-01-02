<?php

namespace App\Http\Controllers\Home;

use App\Comment;
use App\Http\Requests\Home\CommentRequest;
use App\Http\Requests\Home\CommentAnswerRequest;
use System\Auth\Auth;

class CommentController extends HomeController
{

    public function add($courseId)
    {
        Auth::user()->id;
        $request = new CommentRequest();
        $inputs = $request->all();
        $inputs['user_id'] = Auth::user()->id;
        $inputs['course_id'] = $courseId;
        $inputs['approved'] = Auth::user()->user_type == 'admin' ? 1 : 0 ;
        $inputs['status'] = 0;
        Comment::create($inputs);
        error('user_comment', 'نظر شما با موفقیت ثبت شد پس از تایید نمایش داده خواهد شد');
        return back();
    }

    public function answer($commentId){
        if (Auth::checkLogin()) {
            $currentComment = Comment::find($commentId);
            $request = new CommentAnswerRequest();
            $inputs = $request->all();
            $inputs['user_id'] = Auth::user()->id;
            $inputs['course_id'] = $currentComment->course_id;
            $inputs['approved'] = Auth::user()->user_type == 'admin' ? 1 : 0 ;
            $inputs['status'] = 0;
            $inputs['parent_id'] = $commentId;
            Comment::create($inputs);
            error('user_comment', 'نظر شما با موفقیت ثبت شد پس از تایید نمایش داده خواهد شد');
            return back();
        }
        if (Auth::checkLoginProfessor()) {
            $currentComment = Comment::find($commentId);
            $request = new CommentAnswerRequest();
            $inputs = $request->all();
            $inputs['professor_id'] = Auth::professor()->id;
            $inputs['course_id'] = $currentComment->course_id;
            $inputs['approved'] = 1;
            $inputs['status'] = 0;
            $inputs['parent_id'] = $commentId;
            Comment::create($inputs);
            error('user_comment', 'پاسخ شما ثبت شد');
            return back();
        }
    }
}
