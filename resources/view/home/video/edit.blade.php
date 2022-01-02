@extends('home.layouts.app')

@section('head-tag')
<title>ویرایش ویدیو</title>
@endsection

@section('content')
<div class="page-register">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-4 offset-lg-4">
                <div class="base-register shadow-sm">
                    <h3 class="mb-3">ویرایش ویدیو <?= $video->name ?></h3>
                    <form action="<?= route('home.course.video.update', ['id' => $video->id]) ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="put">
                        <div class="form-group">
                            <input type="text" name="name" value="<?= oldOrValue('name', $video->name) ?>" class="form-control <?= errorClass('name') ?>" placeholder="اسم ویدیو">
                            <?= errorText('name') ?>
                        </div>

                        <div class="form-group">
                            <label for="video">آپلود ویدیو</label>
                            <input type="file" name="video" id="fileUp" class="form-control <?= errorClass('video') ?>">
                            <label for="video" class="text-info">حداکثر سایز 300 مگا بیات</label>
                            <?= errorText('video') ?>
                            <?= errorText('file_exists') ?>
                            <input type="hidden" name="time" id="videoTime">
                        </div>

                        <button class="btn btn-fill-secondary d-block w-100">ویرایش</button>


                        <a href="<?= route('home.course.video.list', ['id' => $video->course_id]) ?>" class="d-block mt-3"><button class="btn btn-secondary d-block w-100">بازگشت</button></a>
                </div>
                </form>

            </div>
        </div>
    </div>
</div>
<div class="area">
    <ul class="circles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
</div>
</div>
@endsection

@section('script')
<script src="<?= asset('app/js/getVideoDuration.js') ?>"></script>
@endsection