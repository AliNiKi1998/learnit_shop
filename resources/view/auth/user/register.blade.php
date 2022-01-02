@extends('home.layouts.app')

@section('head-tag')
<title>ثبت نام</title>
@endsection

@section('content')
<!-- Register Page Section -->
<div class="page-register">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-4 offset-lg-4">
                <div class="base-register shadow-sm">
                    <h3 class="mb-3">ایجاد حساب کاربری</h3>
                    <form action="<?= route('auth.register') ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" name="first_name" value="<?= old('first_name') ?>" class="form-control <?= errorClass('first_name') ?>" placeholder="نام خود را وارد کنید...">
                        <?= errorText('first_name') ?>
                        </div>
                        <div class="form-group">
                            <input type="text" name="last_name" value="<?= old('last_name') ?>" class="form-control <?= errorClass('last_name') ?>" placeholder="نام خانوادگی خود را وارد کنید...">
                            <?= errorText('last_name') ?>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" value="<?= old('email') ?>" class="form-control <?= errorClass('email') ?>" placeholder="ایمیل شما...">
                            <?= errorText('email') ?>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" value="<?= old('password') ?>" class="form-control <?= errorClass('password') ?>" placeholder="کلمه عبور...">
                            <?= errorText('password') ?>
                        </div>
                        <div class="form-group">
                            <input type="password" name="confirm_password" value="<?= old('confirm_password') ?>" class="form-control <?= errorClass('confirm_password') ?>" placeholder="تکرار کلمه عبور...">
                            <?= errorText('confirm_password') ?>
                        </div>
                        <div class="form-group">
                        <label for="avatar">عکس پروفایل</label>
                            <input type="file" name="avatar"  class="form-control <?= errorClass('avatar') ?>">
                            <?= errorText('avatar') ?>
                        </div>
                        <div class="login-footer">
                            <label class="check-box">
                                <span>من با شرایط و سیاست سایت موافقم.</span>
                                <input type="checkbox" name="conditions" value="confirm"> <span class="checkmark"></span>
                                <?= errorText('conditions') ?>
                            </label>
                        </div>
                        <div class="btn-login">
                            <button class="btn btn-fill-secondary d-block w-100">ثبت نام</button>
                        </div>
                    </form>
                    <hr>

                    <p>حساب کاربری دارید؟ <a href="<?= route('auth.login.view') ?>">ورود</a></p>
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