@extends('home.layouts.app')

@section('head-tag')
<title>ویرایش اطلاعات استاد</title>
@endsection

@section('content')
<!-- Register Page Section -->
<div class="page-register">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <div class="base-register shadow-sm">
                    <h3 class="mb-3">ویرایش اطلاعات استاد</h3>
                    <form action="<?= route('home.professor.update.info', ['id' => \System\Auth\Auth::professor()->id]) ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="put">
                        <div class="form-group">
                            <label>نام</label>
                            <input type="text" name="first_name" value="<?= oldOrValue('first_name', \System\Auth\Auth::professor()->first_name) ?>" class="form-control <?= errorClass('first_name') ?>" placeholder="نام خود را وارد کنید...">
                            <?= errorText('first_name') ?>
                        </div>
                        <div class="form-group">
                            <label>نام خانوادگی</label>
                            <input type="text" name="last_name" value="<?= oldOrValue('last_name', \System\Auth\Auth::professor()->last_name) ?>" class="form-control <?= errorClass('last_name') ?>" placeholder="نام خانوادگی خود را وارد کنید...">
                            <?= errorText('last_name') ?>
                        </div>

                        <div class="form-group">
                        <label>اینستاگرام</label>
                            <input type="text" name="instagram" value="<?= oldOrValue('instagram', \System\Auth\Auth::professor()->instagram) ?>" class="form-control <?= errorClass('instagram') ?>" placeholder="اینستاگرام">
                            <?= errorText('instagram') ?>
                        </div>

                        <div class="form-group">
                        <label>تلگرام</label>
                            <input type="text" name="telegram" value="<?= oldOrValue('telegram', \System\Auth\Auth::professor()->telegram) ?>" class="form-control <?= errorClass('telegram') ?>" placeholder="تلگرام">
                            <?= errorText('telegram') ?>
                        </div>

                        <div class="form-group">
                        <label>فیس بوک</label>
                            <input type="text" name="facebook" value="<?= oldOrValue('facebook', \System\Auth\Auth::professor()->facebook) ?>" class="form-control <?= errorClass('facebook') ?>" placeholder="فیس بوک">
                            <?= errorText('facebook') ?>
                        </div>

                        <div class="form-group">
                        <label>توضیحات</label>
                            <textarea name="description" cols="30" placeholder="توضیحات مدرس..." rows="10" class="form-control" <?= errorClass('description') ?>>
                           <?= oldOrValue('description', \System\Auth\Auth::professor()->description) ?>
                        </textarea>
                            <?= errorText('description') ?>
                        </div>
                        <div class="form-group">
                            <label for="avatar">عکس پروفایل</label>
                            <input type="file" name="image" class="form-control <?= errorClass('image') ?>">
                            <?= errorText('image') ?>
                        </div>

                        <div class="btn-login">
                            <button class="btn btn-fill-secondary d-block w-100">ویرایش</button>
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
<!-- End Register Page Section -->
@endsection