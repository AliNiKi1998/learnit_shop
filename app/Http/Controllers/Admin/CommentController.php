<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Http\Controllers\Admin\AdminController;

class CommentController extends AdminController
{
    public function index()
    {
        $comments = Comment::all();
        return view('admin.comment.index' , compact('comments'));
    }

    public function show($id){
        $comment = Comment::find($id);
        return view('admin.comment.show' , compact('comment'));
    }

    public function changeStatus($id){
        $comment = Comment::find($id);
        if ($comment->status == 1) {
            $comment->status = 0;
        } else {
            $comment->status = 1;
        }
        $comment->save();
        return back();
    }

    public function confirm($id){
        $comment = Comment::find($id);
        if ($comment->approved == 1) {
            $comment->approved = 0;
        } else {
            $comment->approved = 1;
        }
        $comment->save();
        return back();
    }
}
