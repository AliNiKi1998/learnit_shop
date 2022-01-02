@extends('admin.layouts.app')

@section('head-tag')
<title>ادمین | ویرایش استاد</title>
<!-- form Uploads -->
<link href="<?= asset('panel/assets/plugins/fileuploads/css/dropify.min.css') ?>" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">

            <h4 class="header-title m-t-0 m-b-30"> ویرایش استاد <span class="text-primary"><?= $professor->first_name . ' ' . $professor->last_name ?></span></h4>

            <div class="row">

                <form class="form-horizontal" role="form" method="post" action="<?= route('admin.professor.update', [$professor->id]) ?>" enctype="multipart/form-data">
                    <div class="col-lg-6">
                        <input type="hidden" name="_method" value="put">

                        <div class="form-group">
                            <label class="col-md-2 control-label">نام</label>
                            <div class="col-md-10">
                                <input type="text" name="first_name" placeholder="نام" class="form-control <?= errorClass('first_name') ?>" value="<?= oldOrValue('first_name', $professor->first_name) ?>">
                                <?= errorText('first_name') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">نام خانوادگی</label>
                            <div class="col-md-10">
                                <input type="text" name="last_name" placeholder="نام خانوادگی" class="form-control <?= errorClass('last_name') ?>" value="<?= oldOrValue('last_name', $professor->last_name) ?>">
                                <?= errorText('last_name') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">توضیحات</label>
                            <div class="col-md-10">
                                <textarea name="description" class="form-control <?= errorClass('description') ?>" cols="30" rows="10">
                                <?= trim(oldOrValue('description', $professor->description) , ' ') ?>
                                </textarea>
                                <?= errorText('description') ?>
                            </div>
                        </div>
                      

                        <button type="submit" class="m-t-10 btn btn-info btn-block waves-effect waves-light">ویرایش</button>
                    </div><!-- end col -->
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="col-sm-2 m-b-5 control-label">آپلود عکس</label>
                            <input type="file" name="image" class="dropify" data-default-file="<?= asset($professor->image['big']) ?>" />
                            <?= errorText('image') ?>
                        </div>
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
</script>
@endsection