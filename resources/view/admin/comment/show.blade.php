@extends('admin.layouts.app')

@section('head-tag')
<title>ادمین | نظر </title>
<!-- form Uploads -->
<link href="<?= asset('panel/assets/plugins/fileuploads/css/dropify.min.css') ?>" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">

            <h4 class="header-title m-t-0 m-b-30"> نظر <span class="text-primary"><?= @$comment->user()->first_name . ' ' . @$comment->user()->last_name . @$comment->professor()->first_name . ' ' . @$comment->professor()->last_name ?></span></h4>

            <div class="row">
                <span class="fs-18">متن نظر</span>
                <p><?= $comment->comment ?></p>
            </div><!-- end col -->
            <a href="<?= route('admin.comment.confirm', [$comment->id]) ?>">
                <?= $comment->approved == 1 ? '<button class="btn btn-warning" >لغو تایید</button>' : ' <button class="btn btn-success" >تایید کردن</button>' ?>

            </a>
            <a href="<?= route('admin.comment.change.status', [$comment->id]) ?>">
                <?= $comment->status == 1 ? '<button class="btn btn-warning" >غیر فعال کردن</button>' : ' <button class="btn btn-success" >فعال کردن</button>' ?>

            </a>
        </div><!-- end row -->
    </div>
</div><!-- end col -->
</div>
@endsection