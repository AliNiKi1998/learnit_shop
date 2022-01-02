@extends('admin.layouts.app')

@section('head-tag')
<title>ادمین | ویرایش دوره</title>
<!-- form Uploads -->
<link href="<?= asset('panel/assets/plugins/fileuploads/css/dropify.min.css') ?>" rel="stylesheet" type="text/css" />
<link href="<?= asset('panel/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') ?>" rel="stylesheet" />
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">

            <h4 class="header-title m-t-0 m-b-30"> ویرایش دوره <span class="text-primary"><?= $course->name ?></span></h4>

            <div class="row">

                <form class="form-horizontal" role="form" method="post" action="<?= route('admin.course.update', [$course->id]) ?>" enctype="multipart/form-data">
                    <div class="col-lg-6">
                        <input type="hidden" name="_method" value="put">

                        <div class="form-group">
                            <label class="col-md-2 control-label">نام</label>
                            <div class="col-md-10">
                                <input type="text" name="name" placeholder="نام" class="form-control <?= errorClass('name') ?>" value="<?= oldOrValue('name', $course->name) ?>">
                                <?= errorText('name') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">قیمت</label>
                            <div class="col-md-10">
                                <input type="number" name="price" placeholder="قیمت" class="form-control <?= errorClass('price') ?>" value="<?= oldOrValue('price', $course->price) ?>">
                                <?= errorText('price') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>تگ ها</label>
                            <?php
                            $tags = explode(' ', oldOrValue('tags', $course->tags));
                            $tags = implode(',', $tags)
                            ?>
                            <input type="text" name="tags" value="<?= $tags ?>" class="form-control <?= errorClass('tags') ?>" data-role="tagsinput" placeholder="افزودن تگ" />
                            <?= errorText('tags') ?>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-2 control-label">انتخاب دسته بندی</label>
                            <div class="col-sm-10">
                                <select name="cat_id" class="form-control <?= errorClass('cat_id') ?>">
                                    <option value="">انتخاب دسته بندی</option>
                                    <?php foreach ($categories as $category) { ?>

                                        <option value="<?= $category->id ?>" <?= oldOrValue('cat_id', $course->cat_id) === $category->id ? 'selected' : '' ?>>
                                            <?= $category->name ?>
                                        </option>

                                    <?php  } ?>
                                </select>
                                <?= errorText('cat_id') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 m-b-5 control-label">آپلود عکس</label>
                            <input type="file" name="image" class="dropify" data-default-file="<?= asset($course->image['big']) ?>" />
                            <?= errorText('image') ?>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label class="col-md-2 control-label" style="text-align: right!important;">توضیحات</label>
                        <div class="form-group">
                            <div class="col-md-10">
                                <textarea name="description" id="description" class="form-control <?= errorClass('description') ?>" cols="30" rows="10">
                                <?= trim(oldOrValue('description', $course->description), ' ') ?>
                                </textarea>
                                <?= errorText('description') ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <button type="submit" class="m-t-10 btn btn-info btn-block waves-effect waves-light">ویرایش</button>
                    </div>
                </form>
            </div><!-- end col -->

        </div><!-- end row -->
    </div>
</div><!-- end col -->
</div>
@endsection

@section('script')
<!-- file uploads js -->
<script src="<?= asset('panel/assets/plugins/fileuploads/js/dropify.min.js') ?>"></script>
<script src="<?= asset('panel/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') ?>"></script>
<script src="<?= asset('ckeditor/ckeditor.js'); ?>"></script>
<script type="text/javascript">
    $('.dropify').dropify({
        messages: {
            'default': 'فایل را به اینجا بکشید یا کلیک کنید',
            'replace': 'برای جایگزینی فایل را به اینجا بکشید یا کلیک کنید',
            'remove': 'پاک کردن',
        },
        error: {
            'fileSize': 'حجم فایل بیشتر از حد مجاز است (1M).'
        }
    });
    CKEDITOR.replace('description');
</script>
@endsection